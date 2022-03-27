<?php
    namespace Classes;
    abstract class  Peca{
        public $nome;
        public $jogadorPeca;
        public $posicaoPecaSelecionada;
        public $tentativaLance;
        public $casasPossiveis = [];
        public $validacaoLance = false;

        public function __construct(Array $lance){
            $this->nome = $lance['pecaSelecionada'];
            $this->jogadorPeca = $lance['JogadorPeca'];
            $this->posicaoPecaSelecionada = str_split(str_replace('|','',$lance['coordenadaPecaSelecionada']));
            $this->tentativaLance =  str_split(str_replace('|','',$lance['coordenadaPecaClicada']));;
            $this->CalcularCasasPossiveis($lance['posicaoAtual']); 
            $this->CalcularTentativaLance($lance['posicaoAtual']);
        }

        public function converterPosicaoParaNumero(){
            $this->posicaoPecaSelecionada[0] = (int)$this->posicaoPecaSelecionada[0];
            $this->posicaoPecaSelecionada[1] = (int)$this->posicaoPecaSelecionada[1];
            $this->tentativaLance[0] = (int)$this->tentativaLance[0];
            $this->tentativaLance[1] = (int)$this->tentativaLance[1];
        }
    }
?>