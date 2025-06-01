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
 * Entity class for "kontak_mitra" table
 */

#[Entity]
#[Table("kontak_mitra", options: ["dbId" => "DB"])]
class KontakMitra extends AbstractEntity
{
    #[Id]
    #[Column(name: "kontak_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $KontakId;

    #[Column(name: "mitra_id", type: "integer")]
    private int $MitraId;

    #[Column(name: "nama_kontak", type: "string")]
    private string $NamaKontak;

    #[Column(name: "jabatan", type: "string", nullable: true)]
    private ?string $Jabatan;

    #[Column(name: "email", type: "string", nullable: true)]
    private ?string $Email;

    #[Column(name: "telepon", type: "string", nullable: true)]
    private ?string $Telepon;

    public function getKontakId(): int
    {
        return $this->KontakId;
    }

    public function setKontakId(int $value): static
    {
        $this->KontakId = $value;
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

    public function getNamaKontak(): string
    {
        return HtmlDecode($this->NamaKontak);
    }

    public function setNamaKontak(string $value): static
    {
        $this->NamaKontak = RemoveXss($value);
        return $this;
    }

    public function getJabatan(): ?string
    {
        return HtmlDecode($this->Jabatan);
    }

    public function setJabatan(?string $value): static
    {
        $this->Jabatan = RemoveXss($value);
        return $this;
    }

    public function getEmail(): ?string
    {
        return HtmlDecode($this->Email);
    }

    public function setEmail(?string $value): static
    {
        $this->Email = RemoveXss($value);
        return $this;
    }

    public function getTelepon(): ?string
    {
        return HtmlDecode($this->Telepon);
    }

    public function setTelepon(?string $value): static
    {
        $this->Telepon = RemoveXss($value);
        return $this;
    }
}
