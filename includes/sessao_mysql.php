<?php
declare(strict_types=1);

// As funções da Vercel não partilham ficheiros locais entre pedidos.
final class SessaoMySQL implements SessionHandlerInterface, SessionUpdateTimestampHandlerInterface
{
    private ?string $bloqueio = null;

    public function __construct(private PDO $pdo) {}

    public function open(string $path, string $name): bool { return true; }

    private function desbloquear(): void
    {
        if ($this->bloqueio !== null) {
            $stmt = $this->pdo->prepare('SELECT RELEASE_LOCK(?)');
            $stmt->execute([$this->bloqueio]);
            $this->bloqueio = null;
        }
    }

    public function close(): bool { $this->desbloquear(); return true; }

    public function read(string $id): string|false
    {
        $this->desbloquear();
        $chave = 'wf_' . substr(hash('sha256', $id), 0, 60);
        $stmt = $this->pdo->prepare('SELECT GET_LOCK(?, 10)');
        $stmt->execute([$chave]);
        if ((int) $stmt->fetchColumn() !== 1) return false;
        $this->bloqueio = $chave;
        $stmt = $this->pdo->prepare('SELECT dados FROM sessoes WHERE id = ? AND expira_em > NOW()');
        $stmt->execute([$id]);
        $dados = $stmt->fetchColumn();
        return $dados === false ? '' : $dados;
    }

    public function write(string $id, string $data): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO sessoes (id, dados, expira_em) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 30 MINUTE)) ON DUPLICATE KEY UPDATE dados = VALUES(dados), expira_em = VALUES(expira_em)');
        return $stmt->execute([$id, $data]);
    }

    public function destroy(string $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM sessoes WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function gc(int $max_lifetime): int|false
    {
        return $this->pdo->exec('DELETE FROM sessoes WHERE expira_em <= NOW()');
    }

    public function validateId(string $id): bool
    {
        $stmt = $this->pdo->prepare('SELECT 1 FROM sessoes WHERE id = ? AND expira_em > NOW()');
        $stmt->execute([$id]);
        return (bool) $stmt->fetchColumn();
    }

    public function updateTimestamp(string $id, string $data): bool
    {
        return $this->write($id, $data);
    }
}
