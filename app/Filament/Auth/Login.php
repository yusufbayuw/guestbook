<?php

namespace App\Filament\Auth;

use DominionSolutions\FilamentCaptcha\Forms\Components\Captcha;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;

class Login extends BaseAuth 
{
    public function form(Form $form): Form
    {
        return $form
        ->schema([
        $this->getEmailFormComponent(),
        //$this->getLoginFormComponent(),
        $this->getPasswordFormComponent(),
        Captcha::make('captcha')
            ->rules(['captcha'])
            ->required()
            ->validationMessages([
                'captcha' => __('Captcha tidak sesuai'),
            ]),
        $this->getRememberFormComponent(),
        ])
        ->statePath('data');
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
        ->label('Email/Username')
        ->required()
        ->autocomplete()
        ->autofocus()
        ->extraInputAttributes(['tabindex' => 1]);;
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['email'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
 
        return [
            $login_type => $data['email'],
            'password'  => $data['password'],
        ];
    }
}