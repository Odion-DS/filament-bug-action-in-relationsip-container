<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
          TextInput::make('title'),
            TextEntry::make('model-relation')
                ->columnStart(1)
                ->state(fn($record) => $record::class),
          Fieldset::make('User')
              ->columnStart(1)
              ->relationship('user')
              ->columns(1)
            ->components([
                TextEntry::make('model-relation')
                    ->state(fn($record) => $record::class),
                Action::make('test_action')
                    ->label(fn($record) => $record::class)
                    ->action(fn($record) => dd($record)),
                Action::make('inSchema')
                ->schema([
                    TextInput::make('model-relation')
                        ->label(fn($record) => dd($record::class)),
                ])
            ])
        ]);
    }


}
