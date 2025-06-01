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
 * Entity class for "kerjasama" table
 */

#[Entity]
#[Table("kerjasama", options: ["dbId" => "DB"])]
class Kerjasama extends AbstractEntity
{
    #[Id]
    #[Column(name: "kerjasama_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $KerjasamaId;

    #[Column(name: "mitra_id", type: "integer")]
    private int $MitraId;

    #[Column(name: "judul_kerjasama", type: "string")]
    private string $JudulKerjasama;

    #[Column(name: "deskripsi", type: "text", nullable: true)]
    private ?string $Deskripsi;

    #[Column(name: "tanggal_mulai", type: "date")]
    private DateTime $TanggalMulai;

    #[Column(name: "tanggal_berakhir", type: "date")]
    private DateTime $TanggalBerakhir;

    #[Column(name: "jenis_kerjasama", type: "string")]
    private string $JenisKerjasama;

    #[Column(name: "dokumen_path", type: "string", nullable: true)]
    private ?string $DokumenPath;

    #[Column(name: "status", type: "string", nullable: true)]
    private ?string $Status;

    public function __construct()
    {
        $this->Status = "Aktif";
    }

    public function getKerjasamaId(): int
    {
        return $this->KerjasamaId;
    }

    public function setKerjasamaId(int $value): static
    {
        $this->KerjasamaId = $value;
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

    public function getJudulKerjasama(): string
    {
        return HtmlDecode($this->JudulKerjasama);
    }

    public function setJudulKerjasama(string $value): static
    {
        $this->JudulKerjasama = RemoveXss($value);
        return $this;
    }

    public function getDeskripsi(): ?string
    {
        return HtmlDecode($this->Deskripsi);
    }

    public function setDeskripsi(?string $value): static
    {
        $this->Deskripsi = RemoveXss($value);
        return $this;
    }

    public function getTanggalMulai(): DateTime
    {
        return $this->TanggalMulai;
    }

    public function setTanggalMulai(DateTime $value): static
    {
        $this->TanggalMulai = $value;
        return $this;
    }

    public function getTanggalBerakhir(): DateTime
    {
        return $this->TanggalBerakhir;
    }

    public function setTanggalBerakhir(DateTime $value): static
    {
        $this->TanggalBerakhir = $value;
        return $this;
    }

    public function getJenisKerjasama(): string
    {
        return $this->JenisKerjasama;
    }

    public function setJenisKerjasama(string $value): static
    {
        if (!in_array($value, ["MoU", "MoA", "Proyek"])) {
            throw new \InvalidArgumentException("Invalid 'jenis_kerjasama' value");
        }
        $this->JenisKerjasama = $value;
        return $this;
    }

    public function getDokumenPath(): ?string
    {
        return HtmlDecode($this->DokumenPath);
    }

    public function setDokumenPath(?string $value): static
    {
        $this->DokumenPath = RemoveXss($value);
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $value): static
    {
        if (!in_array($value, ["Aktif", "Kadaluarsa", "Dalam Perpanjangan"])) {
            throw new \InvalidArgumentException("Invalid 'status' value");
        }
        $this->Status = $value;
        return $this;
    }
}
