<?php
include_once "Cliente.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";

class Videoclub {
    private string $nombre;
    private array $productos = [];
    private array $socios = [];

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    // Métodos de inclusión
    private function incluirProducto(Soporte $s): void {
        $this->productos[] = $s;
        echo "<br>Incluido soporte: {$s->titulo}";
    }

    public function incluirCintaVideo(string $titulo, float $precio, int $duracion): void {
        $num = count($this->productos) + 1;
        $this->incluirProducto(new CintaVideo($titulo, $num, $precio, $duracion));
    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $formatoPantalla): void {
        $num = count($this->productos) + 1;
        $this->incluirProducto(new Dvd($titulo, $num, $precio, $idiomas, $formatoPantalla));
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $min, int $max): void {
        $num = count($this->productos) + 1;
        $this->incluirProducto(new Juego($titulo, $num, $precio, $consola, $min, $max));
    }

    // Socios
    public function incluirSocio(string $nombre, int $maxAlquilerConcurrente = 3): void {
        $num = count($this->socios) + 1;
        $this->socios[$num] = new Cliente($nombre, $num, $maxAlquilerConcurrente);
        echo "<br>Incluido socio: {$nombre} (nº {$num})";
    }

    // Mostrar listados
    public function listarProductos(): void {
        echo "<br><strong>Listado de productos:</strong><br>";
        foreach ($this->productos as $p) {
            $p->muestraResumen();
        }
    }

    public function listarSocios(): void {
        echo "<br><strong>Listado de socios:</strong><br>";
        foreach ($this->socios as $socio) {
            echo "Socio nº {$socio->getNumero()}<br>";
        }
    }

    // Alquiler y devolución
    public function alquilarSocioProducto(int $numSocio, int $numSoporte): void {
        if (!isset($this->socios[$numSocio])) {
            echo "<br>No existe el socio nº {$numSocio}";
            return;
        }
        if (!isset($this->productos[$numSoporte - 1])) {
            echo "<br>No existe el soporte nº {$numSoporte}";
            return;
        }
        $socio = $this->socios[$numSocio];
        $soporte = $this->productos[$numSoporte - 1];
        $socio->alquilar($soporte);
    }
}
