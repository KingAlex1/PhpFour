<?php

trait Back
{
    protected function backWayGear()
    {
        echo "Задняя передача" . PHP_EOL;;
    }
}

trait TransmissionAuto
{
    use Back;

    protected function goforward()
    {
        echo "Режим езды вперед" . PHP_EOL;
        return 1;
    }
}

trait TransmissionManual
{
    use Back;

    protected function firstGear()
    {
        echo " Едем на первой передаче" . PHP_EOL;
    }

    protected function secondGear()
    {
        echo "Едем на вторая передаче" . PHP_EOL;
    }
}

trait Engine
{
    private $capacity = 25;
    protected $temperature;


    public function start()
    {
        echo "Запустили двигатель" . PHP_EOL;

    }

    public function stop()
    {
        echo "Заглушили двигатель" . PHP_EOL;
        echo "Приехали !!!" . PHP_EOL;
    }

    public function cooling()
    {
        $this->temperature -= 10;
        echo "Охлаждаем двигатель на 10 градусов" . PHP_EOL;
        echo "Охлажденная темпиратура " . $this->temperature . PHP_EOL;;
    }
}


class Car
{
    use Engine ;
    public $distance;
    public $speed;
    public $destination;


    public function drive()
    {
        $path = 0;
        static $i;
        while ($path < $this->distance) {
            sleep(1);
            $path += $this->speed;
            echo "проехали " . $path . " метров " . PHP_EOL;
            for (; $i < $path; $i = $i + 10) {
                $this->temperature += 5;
                echo "темпиратура двигателя увеличилась на 5 градусов" . PHP_EOL;
                echo "темпиратура :" . $this->temperature . " градусов " . PHP_EOL;

            }
            if ($this->temperature > 90) {
                $this->cooling();

            }

        }
    }
}

class Niva extends Car

{
    use Engine ;
    use TransmissionManual;

    function __construct($dist, $speed, $dest)
    {
        $this->distance = $dist;
        $this->speed = $speed;
        $this->destination = $dest;
    }

    function getNiva()
    {
        if ($this->speed > ($this->capacity * 2)) {
            echo "Слишком быстро, максимальная " . $this->capacity * 2 . " скорость км" .
                PHP_EOL;
        } elseif ($this->destination == 1 && $this->speed < 20) {
            $this->start();
            $this->firstGear();
            $this->drive();
            $this->stop();

        } elseif ($this->destination == 1 && $this->speed > 20) {
            $this->start();
            $this->secondGear();
            $this->drive();
            $this->stop();

        } elseif ($this->destination == 0) {
            $this->start();
            $this->backWayGear();
            $this->drive();
            $this->stop();
        }
    }
}

$Nive = new Niva(400, 15, 1);
$Nive->getNiva();






// dest = 1 = вперед, 0 - назад



