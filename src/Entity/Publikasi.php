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
 * Entity class for "publikasi" table
 */

#[Entity]
#[Table("publikasi", options: ["dbId" => "DB"])]
class Publikasi extends AbstractEntity
{
    #[Id]
    #[Column(name: "publikasi_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $PublikasiId;

    #[Column(name: "judul", type: "string")]
    private string $Judul;

    #[Column(name: "konten", type: "text")]
    private string $Konten;

    #[Column(name: "tanggal_publikasi", type: "date")]
    private DateTime $TanggalPublikasi;

    #[Column(name: "jenis_media", type: "string")]
    private string $JenisMedia;

    #[Column(name: "gambar_path", type: "string", nullable: true)]
    private ?string $GambarPath;

    #[Column(name: "penulis_id", type: "integer")]
    private int $PenulisId;

    public function getPublikasiId(): int
    {
        return $this->PublikasiId;
    }

    public function setPublikasiId(int $value): static
    {
        $this->PublikasiId = $value;
        return $this;
    }

    public function getJudul(): string
    {
        return HtmlDecode($this->Judul);
    }

    public function setJudul(string $value): static
    {
        $this->Judul = RemoveXss($value);
        return $this;
    }

    public function getKonten(): string
    {
        return HtmlDecode($this->Konten);
    }

    public function setKonten(string $value): static
    {
        $this->Konten = RemoveXss($value);
        return $this;
    }

    public function getTanggalPublikasi(): DateTime
    {
        return $this->TanggalPublikasi;
    }

    public function setTanggalPublikasi(DateTime $value): static
    {
        $this->TanggalPublikasi = $value;
        return $this;
    }

    public function getJenisMedia(): string
    {
        return $this->JenisMedia;
    }

    public function setJenisMedia(string $value): static
    {
        if (!in_array($value, ["Website", "Sosial Media", "Press Release"])) {
            throw new \InvalidArgumentException("Invalid 'jenis_media' value");
        }
        $this->JenisMedia = $value;
        return $this;
    }

    public function getGambarPath(): ?string
    {
        return HtmlDecode($this->GambarPath);
    }

    public function setGambarPath(?string $value): static
    {
        $this->GambarPath = RemoveXss($value);
        return $this;
    }

    public function getPenulisId(): int
    {
        return $this->PenulisId;
    }

    public function setPenulisId(int $value): static
    {
        $this->PenulisId = $value;
        return $this;
    }
}
