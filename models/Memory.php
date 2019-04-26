<?php
/**
 * Created by PhpStorm.
 * User: Usuário
 * Date: 05/12/2018
 * Time: 21:41
 */

include "Cell.php";

class Memory
{
    private $cells;
    private $alpha;
    private $currName;
    
    /**
     * cells constructor.
     * @param $cell
     */
    public function __construct()
    {
        $this->cell = array();
        $this->alpha = range('A', 'Z');
        $this->currName = 0;
    }

    public function initMemory($value)
    {
        for($i = 0; $i < $value; $i++)
        {
            $this->cells[$i] = new Cell(rand(10, 50));
        }

    }

    public function addProcessFirstFit($value)
    {
        $rest = 0;

        for($i = 0; $i < count($this->cells); $i++)
        {
            if($this->cells[$i]->getOcuped() == 0 && $this->cells[$i]->getSize() >= $value)
            {
                $this->cells[$i]->setOcuped($value);
                $this->cells[$i]->setName($this->alpha[$this->currName]);
                $this->currName++;

                $rest = $this->cells[$i]->getSize() - $this->cells[$i]->getOcuped();
                $this->cells[$i]->setSize($value);
                break;
            }
        }

        if($rest > 0)
            $this->swap($rest, $i);

        if($i == count($this->cells))
        {
            echo "Não foi possível adicionar";
        }
    }

    public function addProcessBestFit($value)
    {
        $rest = 0;
        $best = -1;

        for($i = 0; $i < count($this->cells); $i++)
        {
            if($this->cells[$i]->getOcuped() == 0 && $this->cells[$i]->getSize() >= $value)
            {
                if($best == -1)
                    $best = $i;
                else if($this->cells[$best]->getSize() > $this->cells[$i]->getSize())
                {
                    $best = $i;
                }
            }
        }

        if($best != -1)
        {
            $this->cells[$best]->setOcuped($value);
            $rest = $this->cells[$best]->getSize() - $this->cells[$best]->getOcuped();
            $this->cells[$best]->setSize($value);
            $this->cells[$best]->setName($this->alpha[$this->currName]);
            $this->currName++;

            if($rest > 0)
            {
                $this->swap($rest, $best);
            }
        }
    }


    public function addProcessWorstFit($value)
    {
        $rest = 0;
        $worst = -1;

        for($i = 0; $i < count($this->cells); $i++)
        {
            if($this->cells[$i]->getOcuped() == 0 && $this->cells[$i]->getSize() >= $value)
            {
                if($worst == -1)
                    $worst = $i;
                else if($this->cells[$worst]->getSize() < $this->cells[$i]->getSize())
                {
                    $worst = $i;
                }
            }
        }

        if($worst != -1)
        {
            $this->cells[$worst]->setOcuped($value);
            $rest = $this->cells[$worst]->getSize() - $this->cells[$worst]->getOcuped();
            $this->cells[$worst]->setSize($value);
            $this->cells[$worst]->setName($this->alpha[$this->currName]);
            $this->currName++;

            if($rest > 0)
            {
                $this->swap($rest, $worst);
            }
        }
    }

    public function getCells()
    {
        $str = "<table class=\"table\">";
        $str .= "<thead>
            <th>Nome</th><th>Ocupado</th><th>Tamanho</th>
            <thead>";
            
        foreach ($this->cells as $cell)
        {
            if($this->currName > 0 && $cell->getName() === $this->alpha[$this->currName - 1])
            {
                $str .= "<tr class=\"table-primary\">";
            } 
            else 
            {
                $str .= "<tr>";
            }
            $str .= "<td>".$cell->getName()."</td>";
            $str .= "<td>".$cell->getOcuped()."</td>";
            $str .= "<td>".$cell->getSize()."</td></tr>";
        }

        $str .= "</table>";

        return $str;
    }

    public function swap($value, $pos){
        $this->cells[] = new Cell($value);

        for($i = $pos+1; $i < count($this->cells); $i++)
        {
            $aux = $this->cells[count($this->cells) - 1];
            $this->cells[count($this->cells) - 1] = $this->cells[$i];
            $this->cells[$i] = $aux;
        }
    }

    public function remove($name)
    {  
        for($i = 0; $i < count($this->cells); $i++)
        {
            if($this->cells[$i]->getName() === strtoupper($name))
            {
                $this->cells[$i]->setName("");
                $this->cells[$i]->setOcuped(0);
            }
        }
    }
}