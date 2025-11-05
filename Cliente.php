<?php
include_once "Soporte.php";

class Cliente {
    private string $nombre;
    private int $numero;
    private int $maxAlquilerConcurrente;
    private array $soportesAlquilados = [];

    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente = 3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function setNumero(int $numero): void {
        $this->numero = $numero;
    }

    public function getNumSoportesAlquilados(): int {
        return count($this->soportesAlquilados);
    }

    public function tieneAlquilado(Soporte $s): bool {
        foreach ($this->soportesAlquilados as $soporte) {
            if ($soporte === $s) return true;
        }
        return false;
    }

    public function alquilar(Soporte $s): bool {
        if ($s->estaAlquilado()) {
            echo "<br>El soporte '{$s->titulo}' ya está alquilado.";
            return false;
        }

        if ($this->getNumSoportesAlquilados() >= $this->maxAlquilerConcurrente) {
            echo "<br>{$this->nombre} ha alcanzado su máximo de alquileres.";
            return false;
        }

        $this->soportesAlquilados[] = $s;
        $s->marcarAlquilado();
        echo "<br>{$this->nombre} ha alquilado '{$s->titulo}'.";
        return true;
    }

    public function devolver(int $numSoporte): bool {
        foreach ($this->soportesAlquilados as $i => $s) {
            if ($s->numero === $numSoporte) {
                unset($this->soportesAlquilados[$i]);
                $s->marcarDevuelto();
                echo "<br>{$this->nombre} ha devuelto '{$s->titulo}'.";
                return true;
            }
        }
        echo "<br>{$this->nombre} no tiene alquilado el soporte con número $numSoporte.";
        return false;
    }

    public function listarAlquileres(): void {
        echo "<br>{$this->nombre} tiene " . count($this->soportesAlquilados) . " alquiler(es):<br>";
        foreach ($this->soportesAlquilados as $s) {
            echo "- {$s->titulo}<br>";
        }
    }
}
