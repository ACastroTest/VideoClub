<?php
interface Resumible {
    public function muestraResumen(): void;
}

abstract class Soporte implements Resumible {
    public string $titulo;
    public int $numero;
    public float $precio;
    protected bool $alquilado = false;
    private static float $IVA = 0.21;

    public function __construct(string $titulo, int $numero, float $precio) {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function getPrecioConIva(): float {
        return round($this->precio * (1 + self::$IVA), 2);
    }

    public function estaAlquilado(): bool {
        return $this->alquilado;
    }

    public function marcarAlquilado(): void {
        $this->alquilado = true;
    }

    public function marcarDevuelto(): void {
        $this->alquilado = false;
    }

    public function muestraResumen(): void {
        echo "<br>Soporte nº {$this->numero}: <strong>{$this->titulo}</strong><br>";
        echo "Precio: {$this->precio}€ (IVA incluido: {$this->getPrecioConIva()}€)<br>";
    }
}
