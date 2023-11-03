<?php

    class partida{
        //ATTR of partida
        private $jogador;
        private $acertos;
        private $erros;
        private $data_hora;

        //GETTERS and SETTERS
        public function getJogador()
        {
                return $this->jogador;
        }

        public function setJogador($jogador)
        {
                $this->jogador = $jogador;

                return $this;
        }

        public function getAcertos()
        {
                return $this->acertos;
        }

        public function setAcertos($acertos)
        {
                $this->acertos = $acertos;

                return $this;
        }

        public function getErros()
        {
                return $this->erros;
        }

        public function setErros($erros)
        {
                $this->erros = $erros;

                return $this;
        }
 
        public function getData_hora()
        {
                return $this->data_hora;
        }

        public function setData_hora($data_hora)
        {
                $this->data_hora = $data_hora;

                return $this;
        }

        //Function Connect
        public function connect(){
            //connection DB
            $db = new PDO("sqlite:".__DIR__."/"."../db/pokeinfoDB");
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            return $db;
        }

        //Function Save
        public function save(){
            $db = $this->connect();

            $q = $db->prepare("INSERT INTO partida (jogador, acertos, erros, data_hora)
                 VALUES (:jogador, :acertos, :erros, :data_hora)");
            $q->bindParam(":jogador", $this->getJogador());
            $q->bindParam(":acertos", $this->getAcertos());
            $q->bindParam(":erros", $this->getErros());
            $q->bindParam(":data_hora", $this->getData_hora());

            $q->execute();
        }

        //Function List
        public function list(){
            $db = $this->connect();

            $q = $db->prepare("SELECT * FROM partida order by acertos desc, erros asc, data_hora desc");
            $q->execute();
            $partida = $q->fetchAll();

            return $partida;
        }
    }