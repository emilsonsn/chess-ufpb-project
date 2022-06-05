<?php
    namespace Classes;
    class ReiController{
        public function __construct($posicaoTabuleiro, $JogadorPecaSelecionada){
            $this->posicaoTabuleiro = $posicaoTabuleiro;
            $this->JogadorPecaSelecionada= explode("_",$JogadorPecaSelecionada)[1];
            $this->getPosicaoRei();
        }
        
        public function getPosicaoRei (){
            for($contador=0; $contador<=7; $contador++){
                foreach($this->posicaoTabuleiro[$contador] as $colunaIndice => $colunaValue){
                    if(explode("_",$colunaValue)[0] == 'Rei' && explode("_",$colunaValue)[1] == $this->JogadorPecaSelecionada){
                        $this->posicaoRei = [$contador, $colunaIndice];
                    }
                }        
            }
        }

        public function verificarAmeacaRei(){
            if(
            $this->verificarAmecaPeao()
            ){
                return false;
            }
            return true;
        }

        public function verificarAmecaPeao(){
            if($this->JogadorPecaSelecionada == "B"){
                if($this->posicaoTabuleiro[$this->posicaoRei[0]-1][$this->posicaoRei[1]-1] == "Peao_P" ||
                   $this->posicaoTabuleiro[$this->posicaoRei[0]-1][$this->posicaoRei[1]+1] == "Peao_P"
                ){
                    return true;
                }
            return false;
            }
            else{
                if($this->posicaoTabuleiro[$this->posicaoRei[0]+1][$this->posicaoRei[1]-1] == "Peao_B" ||
                   $this->posicaoTabuleiro[$this->posicaoRei[0]+1][$this->posicaoRei[1]+1] == "Peao_B"
                ){
                    return true;
                }
            return false;
            }
        }
    }