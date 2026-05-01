<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Article Content')
                    ->description('Main content and visual assets of your post.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Post::class, 'slug', ignoreRecord: true),

                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('posts/content'),

                        \Filament\Forms\Components\Grid::make(2)
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                        TextInput::make('slug')
                                            ->required()
                                            ->unique(\App\Models\Category::class, 'slug'),
                                    ]),
                                
                                Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                \Filament\Forms\Components\Group::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Status & Visibility')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'scheduled' => 'Scheduled'
                                    ])
                                    ->required()
                                    ->default('draft')
                                    ->native(false),

                                DateTimePicker::make('published_at')
                                    ->label('Publication Date'),

                                Toggle::make('is_featured')
                                    ->label('Feature this post')
                                    ->helperText('Featured posts appear in the hero section.')
                                    ->onIcon('heroicon-m-bolt')
                                    ->offIcon('heroicon-m-x-mark'),

                                TextInput::make('reading_time')
                                    ->numeric()
                                    ->suffix('minutes'),
                                
                                Select::make('user_id')
                                    ->label('Author')
                                    ->relationship('user', 'name')
                                    ->default(auth()->id())
                                    ->required(),
                            ]),

                        \Filament\Forms\Components\Section::make('Image')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('thumbnails')
                                    ->disk('public'),
                            ]),

                        \Filament\Forms\Components\Section::make('SEO')
                            ->collapsed()
                            ->schema([
                                TextInput::make('meta_title')
                                    ->maxLength(60),
                                Textarea::make('meta_description')
                                    ->maxLength(160)
                                    ->rows(3),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
