<?php
    namespace Classes;
    use Classes\Peca as Peca;
     class Peao extends Peca{

        public function CalcularCasasPossiveis($lance){
            $this->converterPosicaoParaNumero();
            if ($this->jogadorPeca == 'brancas'){
                if($lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]-1,$this->posicaoPecaSelecionada[1]]);
                }
                if(
                $this->posicaoPecaSelecionada[0] == 6 &&
                $lance[$this->posicaoPecaSelecionada[0]-2][$this->posicaoPecaSelecionada[1]] == 'vazio' &&
                $lance[$this->posicaoPecaSelecionada[0]-1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]-2,$this->posicaoPecaSelecionada[1]]);
                }
            }
            else{
                if($lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]+1,$this->posicaoPecaSelecionada[1]]);
                }
                if(
                $this->posicaoPecaSelecionada[0] == 1 &&
                $lance[$this->posicaoPecaSelecionada[0]+2][$this->posicaoPecaSelecionada[1]] == 'vazio' &&
                $lance[$this->posicaoPecaSelecionada[0]+1][$this->posicaoPecaSelecionada[1]] == 'vazio'){
                    array_push($this->casasPossiveis,[$this->posicaoPecaSelecionada[0]+2,$this->posicaoPecaSelecionada[1]]);
                }
            }
        }

        public function CalcularTentativaLance($posicaoPecaSelecionada){
            foreach($this->casasPossiveis as $indice => $value){
                if($this->tentativaLance == $value){
                    $this->validacaoLance = true;
                }
            }
        }
    }
?>