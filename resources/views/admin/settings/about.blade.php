@extends('layouts.admin')

@section('title', 'About Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">About Page Settings</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 text-dark">
        <ul class="nav nav-tabs card-header-tabs" id="aboutSettingsTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-dark" id="hero-tab" data-bs-toggle="tab" href="#hero" role="tab">Hero Banner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" id="intro-tab" data-bs-toggle="tab" href="#intro" role="tab">Intro Section</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" id="lab-tab" data-bs-toggle="tab" href="#lab" role="tab">Lab Infrastructure</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" id="team-tab" data-bs-toggle="tab" href="#team" role="tab">Team Section</a>
            </li>
        </ul>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.settings.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="tab-content" id="aboutSettingsTabsContent">
                
                <!-- Hero Tab -->
                <div class="tab-pane fade show active" id="hero" role="tabpanel">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Page Heading</label>
                        <input type="text" name="about_hero_title" class="form-control" value="{{ $settings['about_hero_title'] ?? 'About Skill Bridge India' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subheading</label>
                        <textarea name="about_hero_subtitle" class="form-control" rows="3">{{ $settings['about_hero_subtitle'] ?? 'Transforming engineering education into real industry capabilities through practical labs, live projects, and 100% placement support.' }}</textarea>
                    </div>
                </div>

                <!-- Intro Section Tab -->
                <div class="tab-pane fade" id="intro" role="tabpanel">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Badge Text</label>
                        <input type="text" name="about_intro_badge" class="form-control" value="{{ $settings['about_intro_badge'] ?? 'ISO 9001:2015 Certified Institute' }}">
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading (Plain Text)</label>
                            <input type="text" name="about_intro_heading_1" class="form-control" value="{{ $settings['about_intro_heading_1'] ?? 'Bridging Academic Knowledge &' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading (Highlighted Text)</label>
                            <input type="text" name="about_intro_heading_2" class="form-control" value="{{ $settings['about_intro_heading_2'] ?? 'Corporate Execution' }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Main Description (Paragraph 1)</label>
                        <textarea name="about_intro_p1" class="form-control" rows="3">{{ $settings['about_intro_p1'] ?? 'Established with a vision to eliminate the skill gap among engineering graduates, Skill Bridge India Technologies Pvt Ltd delivers industry-aligned training across CS/IT, Electrical, Mechanical, Electronics, and Civil streams.' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Secondary Description (Paragraph 2)</label>
                        <textarea name="about_intro_p2" class="form-control" rows="3">{{ $settings['about_intro_p2'] ?? 'With state-of-the-art training centers in Noida, Lucknow, and Bhopal, we equip students with real-world project exposure, hands-on PLC SCADA & MEP hardware labs, cloud computing pipelines, and AI frameworks.' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Section Image</label>
                        @if(!empty($settings['about_intro_image']))
                            <div class="mb-2">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($settings['about_intro_image']) }}" alt="Intro Image" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" name="about_intro_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep existing image.</small>
                    </div>

                    <hr>
                    <h5 class="fw-bold mb-3">Feature Bullets</h5>
                    <div id="featuresContainer">
                        @foreach($features as $index => $feature)
                        <div class="card mb-3 feature-item">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold">Feature #{{ $index + 1 }}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-feature"><i class="fas fa-trash"></i> Remove</button>
                                </div>
                                <input type="hidden" name="features[{{ $index }}][id]" value="{{ $feature->id }}">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="features[{{ $index }}][title]" class="form-control" value="{{ $feature->title }}" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Icon Class (e.g. fas fa-check-circle)</label>
                                        <input type="text" name="features[{{ $index }}][icon_class]" class="form-control" value="{{ $feature->icon_class }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="addFeatureBtn"><i class="fas fa-plus"></i> Add Feature</button>
                </div>

                <!-- Lab Infrastructure Tab -->
                <div class="tab-pane fade" id="lab" role="tabpanel">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Badge Text</label>
                        <input type="text" name="about_lab_badge" class="form-control" value="{{ $settings['about_lab_badge'] ?? 'Hands-On Facilities' }}">
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading (Plain Text)</label>
                            <input type="text" name="about_lab_heading_1" class="form-control" value="{{ $settings['about_lab_heading_1'] ?? 'State-of-the-Art' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading (Highlighted Text)</label>
                            <input type="text" name="about_lab_heading_2" class="form-control" value="{{ $settings['about_lab_heading_2'] ?? 'Lab Infrastructure' }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Subheading</label>
                        <textarea name="about_lab_subtitle" class="form-control" rows="2">{{ $settings['about_lab_subtitle'] ?? 'Modern practical workstations equipped for software development, cloud computing, and core engineering setups.' }}</textarea>
                    </div>

                    <hr>
                    <h5 class="fw-bold mb-3">Facility Cards</h5>
                    <div id="facilityCardsContainer">
                        @foreach($facilityCards as $index => $card)
                        <div class="card mb-3 facility-card-item">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold">Card #{{ $index + 1 }}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-card"><i class="fas fa-trash"></i> Remove</button>
                                </div>
                                <input type="hidden" name="facility_cards[{{ $index }}][id]" value="{{ $card->id }}">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="facility_cards[{{ $index }}][title]" class="form-control" value="{{ $card->title }}" required>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Icon Class</label>
                                        <input type="text" name="facility_cards[{{ $index }}][icon_class]" class="form-control" value="{{ $card->icon_class }}">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label">Color Theme</label>
                                        <select name="facility_cards[{{ $index }}][color_class]" class="form-select">
                                            <option value="navy" {{ $card->color_class == 'navy' ? 'selected' : '' }}>Navy</option>
                                            <option value="orange" {{ $card->color_class == 'orange' ? 'selected' : '' }}>Orange</option>
                                            <option value="green" {{ $card->color_class == 'green' ? 'selected' : '' }}>Green</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Description</label>
                                        <textarea name="facility_cards[{{ $index }}][description]" class="form-control" rows="2">{{ $card->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="addCardBtn"><i class="fas fa-plus"></i> Add Card</button>
                </div>

                <!-- Team Section Tab -->
                <div class="tab-pane fade" id="team" role="tabpanel">
                    <div class="alert alert-info">
                        <strong>Note:</strong> Team members are managed separately under the <a href="{{ route('admin.team-members.index') }}">Team Members menu</a>. These settings only control the section heading.
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Badge Text</label>
                        <input type="text" name="about_team_badge" class="form-control" value="{{ $settings['about_team_badge'] ?? 'Mentorship & Leadership' }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading (Plain Text)</label>
                            <input type="text" name="about_team_heading_1" class="form-control" value="{{ $settings['about_team_heading_1'] ?? 'Meet Our' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Heading (Highlighted Text)</label>
                            <input type="text" name="about_team_heading_2" class="form-control" value="{{ $settings['about_team_heading_2'] ?? 'Expert Team' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subheading</label>
                        <textarea name="about_team_subtitle" class="form-control" rows="2">{{ $settings['about_team_subtitle'] ?? 'Learn from industry veterans, senior engineers, and experienced mentors.' }}</textarea>
                    </div>
                </div>
                
            </div>
            
            <div class="mt-4 border-top pt-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save About Settings</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let featureIndex = {{ count($features) }};
    const featuresContainer = document.getElementById('featuresContainer');
    document.getElementById('addFeatureBtn').addEventListener('click', function() {
        const html = `
            <div class="card mb-3 feature-item">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 fw-bold">New Feature</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-feature"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" name="features[${featureIndex}][title]" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Icon Class</label>
                            <input type="text" name="features[${featureIndex}][icon_class]" class="form-control" value="fas fa-check-circle">
                        </div>
                    </div>
                </div>
            </div>
        `;
        featuresContainer.insertAdjacentHTML('beforeend', html);
        featureIndex++;
    });

    featuresContainer.addEventListener('click', function(e) {
        if(e.target.closest('.remove-feature')) {
            e.target.closest('.feature-item').remove();
        }
    });

    let cardIndex = {{ count($facilityCards) }};
    const cardsContainer = document.getElementById('facilityCardsContainer');
    document.getElementById('addCardBtn').addEventListener('click', function() {
        const html = `
            <div class="card mb-3 facility-card-item">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 fw-bold">New Card</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-card"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" name="facility_cards[${cardIndex}][title]" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Icon Class</label>
                            <input type="text" name="facility_cards[${cardIndex}][icon_class]" class="form-control" value="fas fa-star">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Color Theme</label>
                            <select name="facility_cards[${cardIndex}][color_class]" class="form-select">
                                <option value="navy">Navy</option>
                                <option value="orange">Orange</option>
                                <option value="green">Green</option>
                            </select>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">Description</label>
                            <textarea name="facility_cards[${cardIndex}][description]" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        cardsContainer.insertAdjacentHTML('beforeend', html);
        cardIndex++;
    });

    cardsContainer.addEventListener('click', function(e) {
        if(e.target.closest('.remove-card')) {
            e.target.closest('.facility-card-item').remove();
        }
    });
});
</script>
@endpush
@endsection
