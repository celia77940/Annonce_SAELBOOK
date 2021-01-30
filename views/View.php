<?php

class view
{
    private $_file;
    private $_t;
    // quand on entre le nom d'un fichier on obteint views/.$action.view.php
    public function __construct($action)
    {
        $this->_file = 'views/'.$action.'.view.php';
    }

    //methode qui génère la vue
    //données que l'on recup pour les mettre dans la vue    
    /**
     * Method generate qui génère et affiche la vue
     *
     * @param $data $data=data que l'on injecte
     *
     * 
     */
    public function generate($data)
    {
        //partie spécifique de la vue
        $content = $this->generateFile($this->_file, $data);
        //template
        $view = $this->generateFile('views/template.php', array('t'=> $this->_t,'content'=>$content));

        echo $view;
    }
    //entre le nom du fichier et les données à recup    
    /**
     * Method generateFile = génère un fichier vue et renvoie le resultat produit
     *
     */
    private function generateFile($file, $data)
    {
        //si fichier existe on extract les données 
        if(file_exists($file))
        {
            //extract toutes les annonces
            extract($data);
            //temporisation declenche la mise en tampon
            ob_start();
            //on inclu le fichier vue
            require $file;
            //arrête la temporisation et renvoie le tampon de sortie
            return ob_get_clean();

        }else{
            // sinon génère une exception
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }

}