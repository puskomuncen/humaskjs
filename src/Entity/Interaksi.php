<?php

namespace PHPMaker2025\humaskerjasama\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2025\humaskerjasama\AdvancedUserInterface;
use PHPMaker2025\humaskerjasama\AbstractEntity;
use PHPMaker2025\humaskerjasama\AdvancedSecurity;
use PHPMaker2025\humaskerjasama\UserProfile;
use PHPMaker2025\humaskerjasama\UserRepository;
use function PHPMaker2025\humaskerjasama\Config;
use function PHPMaker2025\humaskerjasama\EntityManager;
use function PHPMaker2025\humaskerjasama\RemoveXss;
use function PHPMaker2025\humaskerjasama\HtmlDecode;
use function PHPMaker2025\humaskerjasama\HashPassword;
use function PHPMaker2025\humaskerjasama\Security;

/**
 * Entity class for "interaksi" table
 */

#[Entity]
#[Table("interaksi", options: ["dbId" => "DB"])]
class Interaksi extends AbstractEntity
{
    #[Id]
    #[Column(name: "interaksi_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $InteraksiId;

    #[Column(name: "mitra_id", type: "integer")]
    private int $MitraId;

    #[Column(name: "user_id", type: "integer")]
    private int $UserId;

    #[Column(name: "jenis_interaksi", type: "string")]
    private string $JenisInteraksi;

    #[Column(name: "catatan", type: "text", nullable: true)]
    private ?string $Catatan;

    #[Column(name: "tanggal_interaksi", type: "datetime")]
    private DateTime $TanggalInteraksi;

    public function getInteraksiId(): int
    {
        return $this->InteraksiId;
    }

    public function setInteraksiId(int $value): static
    {
        $this->InteraksiId = $value;
        return $this;
    }

    public function getMitraId(): int
    {
        return $this->MitraId;
    }

    public function setMitraId(int $value): static
    {
        $this->MitraId = $value;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->UserId;
    }

    public function setUserId(int $value): static
    {
        $this->UserId = $value;
        return $this;
    }

    public function getJenisInteraksi(): string
    {
        return $this->JenisInteraksi;
    }

    public function setJenisInteraksi(string $value): static
    {
        if (!in_array($value, ["Meeting", "Telepon", "Email", "Event"])) {
            throw new \InvalidArgumentException("Invalid 'jenis_interaksi' value");
        }
        $this->JenisInteraksi = $value;
        return $this;
    }

    public function getCatatan(): ?string
    {
        return HtmlDecode($this->Catatan);
    }

    public function setCatatan(?string $value): static
    {
        $this->Catatan = RemoveXss($value);
        return $this;
    }

    public function getTanggalInteraksi(): DateTime
    {
        return $this->TanggalInteraksi;
    }

    public function setTanggalInteraksi(DateTime $value): static
    {
        $this->TanggalInteraksi = $value;
        return $this;
    }
}
