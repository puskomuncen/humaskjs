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
 * Entity class for "mitra" table
 */

#[Entity]
#[Table("mitra", options: ["dbId" => "DB"])]
class Mitra extends AbstractEntity
{
    #[Id]
    #[Column(name: "mitra_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $MitraId;

    #[Column(name: "nama_mitra", type: "string")]
    private string $NamaMitra;

    #[Column(name: "jenis_mitra", type: "string")]
    private string $JenisMitra;

    #[Column(name: "alamat", type: "text", nullable: true)]
    private ?string $Alamat;

    #[Column(name: "email", type: "string", nullable: true)]
    private ?string $Email;

    #[Column(name: "telepon", type: "string", nullable: true)]
    private ?string $Telepon;

    #[Column(name: "tanggal_bergabung", type: "date", nullable: true)]
    private ?DateTime $TanggalBergabung;

    #[Column(name: "status_aktif", type: "boolean", nullable: true)]
    private ?bool $StatusAktif;

    public function __construct()
    {
        $this->StatusAktif = true;
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

    public function getNamaMitra(): string
    {
        return HtmlDecode($this->NamaMitra);
    }

    public function setNamaMitra(string $value): static
    {
        $this->NamaMitra = RemoveXss($value);
        return $this;
    }

    public function getJenisMitra(): string
    {
        return $this->JenisMitra;
    }

    public function setJenisMitra(string $value): static
    {
        if (!in_array($value, ["Perusahaan", "Pemerintah", "Universitas", "NGO"])) {
            throw new \InvalidArgumentException("Invalid 'jenis_mitra' value");
        }
        $this->JenisMitra = $value;
        return $this;
    }

    public function getAlamat(): ?string
    {
        return HtmlDecode($this->Alamat);
    }

    public function setAlamat(?string $value): static
    {
        $this->Alamat = RemoveXss($value);
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

    public function getTanggalBergabung(): ?DateTime
    {
        return $this->TanggalBergabung;
    }

    public function setTanggalBergabung(?DateTime $value): static
    {
        $this->TanggalBergabung = $value;
        return $this;
    }

    public function getStatusAktif(): ?bool
    {
        return $this->StatusAktif;
    }

    public function setStatusAktif(?bool $value): static
    {
        $this->StatusAktif = $value;
        return $this;
    }
}
