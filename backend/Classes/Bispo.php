<?php
    namespace Classes;
    use Classes\Peca as Peca;
     class Bispo extends Peca{

    public function CalcularCasasPossiveis(Array $lance){

        for($controle = 0; $controle < 4; $controle++){
            $existemCasaNessaDiagonal = true;
            $contador = 1;
            $this->jogadorPeca == 'brancas' ? $this->peca = 'B' : $this->peca = 'P';
            // Diagonal direita superior
            while($existemCasaNessaDiagonal){
                $diagonais = [
                    [$this->posicaoPecaSelecionada[0]-$contador,$this->posicaoPecaSelecionada[1]+$contador],
                    [$this->posicaoPecaSelecionada[0]+$contador,$this->posicaoPecaSelecionada[1]+$contador],
                    [$this->posicaoPecaSelecionada[0]-$contador,$this->posicaoPecaSelecionada[1]-$contador],
                    [$this->posicaoPecaSelecionada[0]+$contador,$this->posicaoPecaSelecionada[1]-$contador]
                ];

                if(
                    $diagonais[$controle][0] <= 7 && $diagonais[$controle][0] >=0 &&
                    $diagonais[$controle][1] <= 7 && $diagonais[$controle][1] >=0
                ){
                    if(
                    isset(explode('_',$lance[$diagonais[$controle][0]][$diagonais[$controle][1]])[1]) &&(
                    explode('_',$lance[$diagonais[$controle][0]][$diagonais[$controle][1]])[1] != $this->peca &&
                    $lance[$diagonais[$controle][0]][$diagonais[$controle][1]] != "vazio"
                    ))
                    {
                        array_push($this->casasPossiveis,$diagonais[$controle]);
                        $existemCasaNessaDiagonal = false;
                    }
                    else if(
                        isset(explode('_',$lance[$diagonais[$controle][0]][$diagonais[$controle][1]])[1]) &&
                        explode('_',$lance[$diagonais[$controle][0]][$diagonais[$controle][1]])[1] == $this->peca
                        ){
                        $existemCasaNessaDiagonal = false;
                    }
                    else if($lance[$diagonais[$controle][0]][$diagonais[$controle][1]] == "vazio"){
                        array_push($this->casasPossiveis,$diagonais[$controle]);
                    }
                }else{
                    $existemCasaNessaDiagonal = false;
                }
                $contador++;
                }
            }
        }
    }
?>