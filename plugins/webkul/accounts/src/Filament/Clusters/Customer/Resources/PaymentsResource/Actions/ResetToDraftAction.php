<?php

namespace Webkul\Account\Filament\Clusters\Customer\Resources\PaymentsResource\Actions;

use Filament\Actions\Action;
use Livewire\Component;
use Webkul\Account\Enums\PaymentStatus;
use Webkul\Account\Models\Payment;

class ResetToDraftAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'customers.payment.reset-to-draft';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('Reset To Draft'))
            ->color('gray')
            ->action(function (Payment $record, Component $livewire): void {
                $record->state = PaymentStatus::DRAFT->value;
                $record->save();

                $livewire->refreshFormData(['state']);
            })
            ->hidden(function (Payment $record) {
                return $record->state == PaymentStatus::DRAFT->value;
            });
    }
}
