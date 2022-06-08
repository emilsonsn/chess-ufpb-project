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
                $this->verificarAmecaPeao() ||
                $this->verificarAmecaCavalo() ||
                $this->verificarAmecaBispo()
            ){
                return false;
            }
            return true;
        }

        public function verificarAmecaPeao(){
            if($this->JogadorPecaSelecionada == "B"){
                if($this->posicaoTabuleiro[$this->posicaoRei[0]-1][$this->posicaoRei[1]-1] == "Peao_P" ||
                   $this->posicaoTabuleiro[$this->posicaoRei[0]-1][$this->posicaoRei[1]+1] == "Peao_P"){
                    return true;
                }
            } else{
                if($this->posicaoTabuleiro[$this->posicaoRei[0]+1][$this->posicaoRei[1]-1] == "Peao_B" ||
                $this->posicaoTabuleiro[$this->posicaoRei[0]+1][$this->posicaoRei[1]+1] == "Peao_B"){
                    return true;
                }
            }
            return false;
        }

        public function verificarAmecaCavalo(){
            $posicoesOndeNaoPodeTerCavalo = [
                [$this->posicaoRei[0]-2, $this->posicaoRei[1]+1],
                [$this->posicaoRei[0]-1, $this->posicaoRei[1]+2],
                [$this->posicaoRei[0]-2, $this->posicaoRei[1]-1],
                [$this->posicaoRei[0]-1, $this->posicaoRei[1]-1],
                [$this->posicaoRei[0]+2, $this->posicaoRei[1]-1],
                [$this->posicaoRei[0]+1, $this->posicaoRei[1]-2],
                [$this->posicaoRei[0]+2, $this->posicaoRei[1]+1],
                [$this->posicaoRei[0]+1, $this->posicaoRei[1]+2]
            ];
            foreach($posicoesOndeNaoPodeTerCavalo as $indice => $posicao){
                $test = $this->posicaoTabuleiro[$posicoesOndeNaoPodeTerCavalo[$indice][0]][$posicoesOndeNaoPodeTerCavalo[$indice][1]];
                if(
                    isset($this->posicaoTabuleiro[$posicoesOndeNaoPodeTerCavalo[$indice][0]][$posicoesOndeNaoPodeTerCavalo[$indice][1]]) &&
                    explode('_',$this->posicaoTabuleiro[$posicoesOndeNaoPodeTerCavalo[$indice][0]][$posicoesOndeNaoPodeTerCavalo[$indice][1]])[0] == "Cavalo" &&
                    explode('_',$this->posicaoTabuleiro[$posicoesOndeNaoPodeTerCavalo[$indice][0]][$posicoesOndeNaoPodeTerCavalo[$indice][1]])[1] != $this->JogadorPecaSelecionada
                ){
                    return true;
                }
            }
            return false;
        }

        public function verificarAmecaBispo(){
            for($contador =1; $contador<4; $contador++){
                $diagonalCondition = true;
                while($diagonalCondition){
                    $diagonais = [
                        [$this->posicaoRei[0]-$contador , $this->posicaoRei[1]+$contador],
                        [$this->posicaoRei[0]-$contador , $this->posicaoRei[1]-$contador],
                        [$this->posicaoRei[0]+$contador , $this->posicaoRei[1]-$contador],
                        [$this->posicaoRei[0]+$contador , $this->posicaoRei[1]+$contador],
                    ];
                    $diagonal = $diagonais[$contador];
                    if(($diagonal[0] > 7 ||$diagonal[0] < 0) || ($diagonal[1] > 7 ||$diagonal[0] < 0) &&
                    $this->posicaoTabuleiro[$diagonal[0]][$diagonal[1]] != "vazio"
                    ){
                        if(isset(explode('_',$this->posicaoTabuleiro[$diagonal[0]][$diagonal[1]])[0]) &&
                           (explode('_',$this->posicaoTabuleiro[$diagonal[0]][$diagonal[1]])[0] == "Bispo" || 
                           explode('_',$this->posicaoTabuleiro[$diagonal[0]][$diagonal[1]])[0] == "Dama") &&
                           explode('_',$this->posicaoTabuleiro[$diagonal[0]][$diagonal[0]])[1] != $thisJogadorPecaSelecionada)
                        {
                            return true;
                        }
                        else{
                            $contador++;
                        }
                    }
                    else{
                        $diagonalCondition = false;
                    }
                }
            }
        }
    }