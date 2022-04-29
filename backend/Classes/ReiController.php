<?php
    namespace Classes;
    class ReiController{
        public function __construct($posicaoTabuleiro, $JogadorPecaSelecionada){
            $this->posicaoTabuleiro = $posicaoTabuleiro;
            $this->JogadorPecaSelecionada= explode("_",$JogadorPecaSelecionada)[1];
        }
        public function validaRei(){
            $this->getPosicaoRei();
            return $this->verificarAmeacaRei();
        }

        public function getPosicaoRei (){
            foreach($this->posicaoTabuleiro as $linhaIndice => $linhaValue){
                foreach($linhaValue as $colunaIndice => $colunaValue){
                    if(explode("_",$colunaValue)[0] == 'rei' && explode("_",$colunaValue)[1] == $this->JogadorPecaSelecionada){
                        $this->posicaoRei = [$linhaIndice, $colunaIndice];
                    }
                }        
            }
        }

        public function verificarAmeacaRei(){
            if(
            $this->verificarAmecaPeao() ||
            $this->verificarAmecaCavalo() ||
            $this->verificarAmecaBispoRainha() ||
            $this->verificarAmecaTorreRainha() ||
            $this->verificarAmeacaReiInimigo()
            ){
                return false;
            }

        }

        public function verificarAmecaPeao(){
            if($JogadorPecaSelecionada == "B"){
                
            }
            else{

            }
        }
    }