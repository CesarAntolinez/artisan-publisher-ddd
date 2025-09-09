<?php

namespace Writing\Domain\Support;

trait RecordsDomainEvents
{
    private array $domainEvents = [];

    public function releaseDomainEvents(): array
    {
        $events = $this->domainEvents;
        $this->domainEvents = []; // Limpiamos los eventos
        return $events;
    }

    protected function recordDomainEvent(object $event): void
    {
        $this->domainEvents[] = $event;
    }
}
