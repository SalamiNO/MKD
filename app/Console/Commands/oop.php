<?php


// trida s hvezdickou
namespace first {

    class A
    {

        private $userId;
        private $name = "Johan";
        private $gender = "F"; //funguje s protected, jelikož second/A rozšiřuje v rámci classy first/A

        public function getSignature()
        {
            return $this->getUserId() . $this->name;
        }

        public function getGender()
        {
            return $this->gender;
        }

        protected function setGender($gender)
        {
            $this->gender=$gender;
        }

        /**
         * @return mixed
         */
        public function getUserId()
        {
            return $this->userId;
        }

        /**
         * @param mixed $userId
         */
        public function setUserId(int $userId)
        {
            $this->userId = $userId;
        }

        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param string $name
         */
        public function setName($name)
        {


            $this->name = $name;
        }

    }
}

// trida s koleckem
namespace second {
    use first;
    class A extends first\A
    {

        public function getSignature()
        {
            return $this->getUserId() . $this->getName() . $this->getGender(); //puvodne $this->gender
        }


    }
}

 //instance tridy s hvezdickou
namespace {

    $johan = new first\A();
    $johan->setUserId(1);
    echo $johan->getSignature();

// instance tridy s koleckem
    $honza = new second\A();
    $honza->setUserId(2);//přidáno kvůli kontrole funkčnosti
    echo $honza->getSignature();
        }


/* výchozí kód ze slacku
         *
         * <?php


// trida s hvezdickou
class A {

    public $userId;
    protected $name = "Johan";
    private $gender = "F";

    public function getSignature() {
        return $this->userId . $this->name;
    }

    protected function getGender(){
        return $this->gender;
    }

}

// trida s koleckem
class A extends A {

    public function getSignature() {
        return $this->userId . $this->name . $this->gender;
    }
}


// instance tridy s hvezdickou
$johan = new A();
$johan->userId = 1;
echo $johan->getSignature();

// instance tridy s koleckem
$honza = new A();
echo $honza->getSignature();
        */
