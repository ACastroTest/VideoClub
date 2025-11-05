<?php
include_once "Soporte.php";

class Juego extends Soporte {
    private string $consola;
    private int $minNumJugadores;
    private int $maxNumJugadores;

    public function __construct(string $titulo, int $numero, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores) {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    private function muestraJugadoresPosibles(): string {
        if ($this->minNumJugadores === $this->maxNumJugadores) {
            return $this->minNumJugadores === 1 ? "Para un jugador" : "Para {$this->minNumJugadores} jugadores";
        }
        return "De {$this->minNumJugadores} a {$this->maxNumJugadores} jugadores";
    }

    public function muestraResumen(): void {
        parent::muestraResumen();
        echo "Consola: {$this->consola}<br>";
        echo $this->muestraJugadoresPosibles() . "<br>";
    }
}
