<?php
include_once "Soporte.php";

class Dvd extends Soporte {
    private array $idiomas;
    private string $formatoPantalla;

    public function __construct(string $titulo, int $numero, float $precio, string $idiomas, string $formatoPantalla) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = explode(",", $idiomas);
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen(): void {
        parent::muestraResumen();
        echo "Idiomas: " . implode(", ", $this->idiomas) . "<br>";
        echo "Formato de pantalla: {$this->formatoPantalla}<br>";
    }
}
