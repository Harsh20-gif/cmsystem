<?php
$dir = __DIR__ . '/app/Models';
$files = scandir($dir);

// Helper function to generate model content
function generateModelContent($name, $traits, $body) {
    $uses = ['use Illuminate\Database\Eloquent\Factories\HasFactory;', 'use Illuminate\Database\Eloquent\Model;'];
    $useStr = implode("\n", $uses);
    $traitStr = count($traits) > 0 ? "    use " . implode(', ', $traits) . ";\n" : "";
    return "<?php\n\nnamespace App\Models;\n\n$useStr\n\nclass $name extends Model\n{\n$traitStr\n    protected \$guarded = [];\n\n$body\n}\n";
}

$modelsData = [
    'CourseCategory' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function courses()
    {
        return \$this->hasMany(Course::class, 'category_id');
    }

    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (\$model) {
            if (empty(\$model->slug)) {
                \$model->slug = \Illuminate\Support\Str::slug(\$model->name);
                \$count = static::whereRaw(\"slug RLIKE '^{\$model->slug}(-[0-9]+)?\$'\")->count();
                \$model->slug = \$count ? \"{\$model->slug}-{\$count}\" : \$model->slug;
            }
        });
    }"
    ],
    'Course' => [
        'traits' => ['HasFactory'],
        'body' => "
    protected \$casts = [
        'technologies' => 'array',
        'certification' => 'boolean',
        'placement_support' => 'boolean',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return \$this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function modules()
    {
        return \$this->hasMany(CourseModule::class)->orderBy('order_position');
    }

    public function faqs()
    {
        return \$this->hasMany(CourseFaq::class)->orderBy('order_position');
    }

    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (\$model) {
            if (empty(\$model->slug)) {
                \$model->slug = \Illuminate\Support\Str::slug(\$model->title);
                \$count = static::whereRaw(\"slug RLIKE '^{\$model->slug}(-[0-9]+)?\$'\")->count();
                \$model->slug = \$count ? \"{\$model->slug}-{\$count}\" : \$model->slug;
            }
        });
    }"
    ],
    'CourseModule' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function course()
    {
        return \$this->belongsTo(Course::class);
    }"
    ],
    'CourseFaq' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function course()
    {
        return \$this->belongsTo(Course::class);
    }"
    ],
    'Training' => [
        'traits' => ['HasFactory'],
        'body' => "
    protected \$casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function course()
    {
        return \$this->belongsTo(Course::class);
    }

    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (\$model) {
            if (empty(\$model->slug)) {
                \$model->slug = \Illuminate\Support\Str::slug(\$model->title);
                \$count = static::whereRaw(\"slug RLIKE '^{\$model->slug}(-[0-9]+)?\$'\")->count();
                \$model->slug = \$count ? \"{\$model->slug}-{\$count}\" : \$model->slug;
            }
        });
    }"
    ],
    'Company' => [
        'traits' => ['HasFactory'],
        'body' => ""
    ],
    'Student' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function course()
    {
        return \$this->belongsTo(Course::class);
    }

    public function placements()
    {
        return \$this->hasMany(Placement::class);
    }"
    ],
    'Placement' => [
        'traits' => ['HasFactory'],
        'body' => "
    protected \$casts = [
        'placement_date' => 'date',
        'published' => 'boolean',
    ];

    public function student()
    {
        return \$this->belongsTo(Student::class);
    }

    public function company()
    {
        return \$this->belongsTo(Company::class);
    }

    public function scopePublished(\$query)
    {
        return \$query->where('published', true);
    }"
    ],
    'GalleryAlbum' => [
        'traits' => ['HasFactory'],
        'body' => "
    protected \$casts = [
        'event_date' => 'date',
    ];

    public function images()
    {
        return \$this->hasMany(GalleryImage::class, 'album_id')->orderBy('order_position');
    }

    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (\$model) {
            if (empty(\$model->slug)) {
                \$model->slug = \Illuminate\Support\Str::slug(\$model->title);
                \$count = static::whereRaw(\"slug RLIKE '^{\$model->slug}(-[0-9]+)?\$'\")->count();
                \$model->slug = \$count ? \"{\$model->slug}-{\$count}\" : \$model->slug;
            }
        });
    }"
    ],
    'GalleryImage' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function album()
    {
        return \$this->belongsTo(GalleryAlbum::class, 'album_id');
    }"
    ],
    'TeamMember' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }"
    ],
    'Testimonial' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function course()
    {
        return \$this->belongsTo(Course::class);
    }

    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }"
    ],
    'Branch' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function scopePublished(\$query)
    {
        return \$query->where('status', 'published');
    }"
    ],
    'Enquiry' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function course()
    {
        return \$this->belongsTo(Course::class);
    }"
    ],
    'Page' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function sections()
    {
        return \$this->hasMany(PageSection::class)->orderBy('order_position');
    }"
    ],
    'PageSection' => [
        'traits' => ['HasFactory'],
        'body' => "
    public function page()
    {
        return \$this->belongsTo(Page::class);
    }"
    ],
    'SiteSetting' => [
        'traits' => ['HasFactory'],
        'body' => ""
    ],
    'Media' => [
        'traits' => ['HasFactory'],
        'body' => ""
    ],
];

foreach ($modelsData as $name => $data) {
    $content = generateModelContent($name, $data['traits'], $data['body']);
    file_put_contents($dir . '/' . $name . '.php', $content);
    echo "Updated $name\n";
}
