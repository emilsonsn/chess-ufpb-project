<?php
    namespace Classes;
    use Classes\Peca as Peca;
     class Dama extends Peca{

        public function CalcularCasasPossiveis(Array $lance){

            // For entre as direções
            for($controle = 0; $controle < 4; $controle++){
                $existemCasaDirecao = true;
                $contador = 1;
                $this->jogadorPeca == 'brancas' ? $this->peca = 'B' : $this->peca = 'P';

                while($existemCasaDirecao){
                    $direcoes = [
                        [$this->posicaoPecaSelecionada[0],$this->posicaoPecaSelecionada[1]+$contador], //direita
                        [$this->posicaoPecaSelecionada[0],$this->posicaoPecaSelecionada[1]-$contador], //esquerda
                        [$this->posicaoPecaSelecionada[0]-$contador,$this->posicaoPecaSelecionada[1]], //cima
                        [$this->posicaoPecaSelecionada[0]+$contador,$this->posicaoPecaSelecionada[1]] //baixo
                    ];

                    if(
                        $direcoes[$controle][0] <= 7 && $direcoes[$controle][0] >=0 &&
                        $direcoes[$controle][1] <= 7 && $direcoes[$controle][1] >=0
                    ){
                        if(
                        isset($lance[$direcoes[$controle][0]][$direcoes[$controle][1]]) && (
                        isset(explode('_',$lance[$direcoes[$controle][0]][$direcoes[$controle][1]])[1]) &&(
                        explode('_',$lance[$direcoes[$controle][0]][$direcoes[$controle][1]])[1] != $this->peca &&
                        $lance[$direcoes[$controle][0]][$direcoes[$controle][1]] != "vazio"
                        )))
                        {
                            array_push($this->casasPossiveis,$direcoes[$controle]);
                            $existemCasaDirecao = false;
                        }
                        else if(
                            isset($lance[$direcoes[$controle][0]][$direcoes[$controle][1]]) && (
                            isset(explode('_',$lance[$direcoes[$controle][0]][$direcoes[$controle][1]])[1]) &&
                            explode('_',$lance[$direcoes[$controle][0]][$direcoes[$controle][1]])[1] == $this->peca
                            )){
                            $existemCasaDirecao = false;
                        }
                        else if(
                            isset($lance[$direcoes[$controle][0]][$direcoes[$controle][1]]) &&(
                            $lance[$direcoes[$controle][0]][$direcoes[$controle][1]] == "vazio")){
                            array_push($this->casasPossiveis,$direcoes[$controle]);
                        }
                    }
                    else{
                        $existemCasaDirecao = false;
                    }
                $contador++;
                }      
            }

            // For entre as diagonais 
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
                    $condicoes = [
                        [($this->posicaoPecaSelecionada[0]-$contador >= 0),($this->posicaoPecaSelecionada[1]+$contador <= 7)],
                        [($this->posicaoPecaSelecionada[0]+$contador <= 7),($this->posicaoPecaSelecionada[1]+$contador<= 7)],
                        [($this->posicaoPecaSelecionada[0]-$contador >= 0),($this->posicaoPecaSelecionada[1]-$contador>= 0)],
                        [($this->posicaoPecaSelecionada[0]+$contador <= 7),($this->posicaoPecaSelecionada[1]-$contador>= 0)]
                    ];
                    if(
                    ($condicoes[$controle][0] &&
                    $condicoes[$controle][1]
                    )){
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