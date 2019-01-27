<?php

class Jugador {

    private $nombre;
    private $valorApuesta;
    private $numeroRuleta;

    function actualizarSaldo($numeroGanador, $saldo, $jugador) {

        //si la apuesta es mayor al saldo no se modifica nada
        if ($numeroGanador != 69 && $saldo >= $jugador->getValorApuesta()) {

            if ($numeroGanador == $jugador->getNumeroRuleta()) {

                if ($jugador->getNumeroRuleta() == 0) {

                    if ($saldo >= ($jugador->getValorApuesta() * 2)) {
                        $saldo += $jugador->getValorApuesta() * 4;
                    }
                    
                } else {
                    $saldo += $jugador->getValorApuesta() * 2;
                }
            } else {

                if ($jugador->getNumeroRuleta() == 0) {

                    if ($saldo >= ($jugador->getValorApuesta() * 2)) {
                        $saldo -= $jugador->getValorApuesta() * 2;
                    }
                    
                } else {
                    $saldo -= $jugador->getValorApuesta();
                }
            }
        }
        return $saldo;
    }

    function saldoInsuficiente($saldo, $jugador) {

        if ($jugador->getNumeroRuleta() != 0) {
            return $jugador->getValorApuesta() > $saldo;
        } else {
            return $jugador->getValorApuesta() * 2 > $saldo;
        }
    }

    function todosPerdieron(array $saldos) {

        for ($i = 0; $i < count($saldos); $i++) {

            if ($saldos[$i] != 0) {
                return false;
            }
        }
        return true;
    }

    function jugadorGanador($numeroGanador, $jugador) {
        return $numeroGanador == $jugador->getNumeroRuleta();
    }

    function __construct($nombre) {
        $this->nombre = $nombre;
        $this->valorApuesta = 0;
        $this->numeroRuleta = 0;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getValorApuesta() {
        return $this->valorApuesta;
    }

    function getNumeroRuleta() {
        return $this->numeroRuleta;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setValorApuesta($valorApuesta) {
        $this->valorApuesta = $valorApuesta;
    }

    function setNumeroRuleta($numeroRuleta) {
        $this->numeroRuleta = $numeroRuleta;
    }

}
