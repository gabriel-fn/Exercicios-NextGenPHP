<?php

// Subject (Assunto)

// Observer (Observador)

class Subject implements \SplSubject
{
    /**
     * @var \SplObserver[] $observers
     */
    protected array $observers;

    #[\Override]
    public function attach(SplObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    #[\Override]
    public function detach(SplObserver $observer): void
    {
        // unset($this->storage[$observer]);
    }

    #[\Override]
    public function notify(): void
    {
        foreach($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class ExibeNoConsoleObserver implements \SplObserver
{
    public function __construct(\SplSubject $subject)
    {
        $subject->attach($this);
    }

    #[\Override]
    public function update(SplSubject $subject): void
    {
        echo 'Hello world from ' . __CLASS__ . PHP_EOL;
    }
}

class ExibeAloNoConsoleObserver implements \SplObserver
{
    public function __construct(\SplSubject $subject)
    {
        $subject->attach($this);
    }

    #[\Override]
    public function update(SplSubject $subject): void
    {
        echo 'Alo from ' . __CLASS__ . PHP_EOL;
    }
}

$subject1 = new Subject('use.update');

new ExibeNoConsoleObserver($subject1);
new ExibeAloNoConsoleObserver($subject1);
new ExibeNoConsoleObserver($subject1);

// Técnica de Mediator passando o subject dentro dos observers
$subject2 = new Subject('use.delete');
new ExibeNoConsoleObserver($subject2);
new ExibeAloNoConsoleObserver($subject2);

$subject1->notify();
$subject2->notify();











