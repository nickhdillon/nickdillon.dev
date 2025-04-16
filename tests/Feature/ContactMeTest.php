<?php

declare(strict_types=1);

use Livewire\Volt\Volt;
use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;

it('can fill out form and send email', function () {
    Mail::fake();

    Volt::test('contact-me')
        ->set('name', 'Nick')
        ->set('email', 'nick@test.com')
        ->set('message', 'Test message')
        ->call('sendEmail')
        ->assertHasNoErrors();

    Mail::assertSent(function (ContactForm $mail) {
        return $mail->hasTo('nickhds@gmail.com') &&
            $mail->name === 'Nick' &&
            $mail->email === 'nick@test.com' &&
            $mail->message === 'Test message';
    });

    Mail::assertSent(ContactForm::class, function (ContactForm $mail) {
        return $mail->hasSubject('nickdillon.dev - Contact Form') &&
            $mail->assertSeeInOrderInHtml(['Nick', 'nick@test.com', 'Test message']);
    });
});

test('component can render', function () {
    Volt::test('contact-me')
        ->assertHasNoErrors();
});
