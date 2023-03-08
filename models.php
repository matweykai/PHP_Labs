<?php

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use \Symfony\Component\Validator\ConstraintViolationListInterface;

class User
{
    private string $creationDate;

    public function __construct(private int $id, private string $name, private string $email, private string $password)
    {   
        $this->creationDate = date('d-m-y h:i:s A');
    }

    public function toStr(): string
    {
        return "$this->id $this->name $this->email $this->password $this->creationDate";
    }
    
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function validateObject(ValidatorInterface $validator): ConstraintViolationListInterface
    {
        $resultErrorsArray = $validator->validate($this->id, [
            new Assert\GreaterThanOrEqual(value: 0),
        ]);

        $resultErrorsArray->addAll($validator->validate($this->name, [
            new Assert\Length(min: 2, max: 10),
        ]));

        $resultErrorsArray->addAll($validator->validate($this->email, [
            new Assert\NotBlank(),
            new Assert\Email(),
        ]));

        $resultErrorsArray->addAll($validator->validate($this->email, [
            new Assert\Length(min: 5, max: 20),
        ]));

        return $resultErrorsArray;
    }
}
