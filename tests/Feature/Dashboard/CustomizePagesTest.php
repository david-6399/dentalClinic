<?php

use App\Models\PageSection;
use App\Models\PageSectionItem;
use App\Services\PageContent;
use Database\Seeders\PageContentSeeder;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    Storage::fake('local');
    $this->seed(PageContentSeeder::class);
});

it('shows the page customization editor', function () {
    $this->get('/dashboard/customize-pages')
        ->assertOk()
        ->assertSee('Customize pages')
        ->assertSee('Home page')
        ->assertSee('Preview page');
});

it('renders every managed public page', function () {
    foreach (PageContent::pages() as $pageKey => $page) {
        $this->get(route($page['route']))
            ->assertOk()
            ->assertSee(PageContent::forPage($pageKey)['hero']['description']);
    }
});

it('saves editor changes through Livewire', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->set('sections.hero.title', 'A brighter smile starts today')
        ->set('sections.services.enabled', false)
        ->call('save')
        ->assertHasNoErrors();

    expect(PageContent::forPage('home')['hero']['title'])->toBe('A brighter smile starts today');
    expect(PageContent::forPage('home')['services']['enabled'])->toBeFalse();
});

it('saves and reorders repeatable section items', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'services')
        ->call('moveItem', 'journey', 0, 1)
        ->set('sections.journey.items.0.title', 'Meet your dentist')
        ->call('save')
        ->assertHasNoErrors();

    $journey = PageContent::forPage('services')['journey']['items'];

    expect($journey[0]['title'])->toBe('Meet your dentist');
    expect($journey[1]['title'])->toBe('Book');

    $this->get('/services')
        ->assertOk()
        ->assertSee('Meet your dentist');
});

it('toggles section visibility without changing pages', function () {
    $editor = Livewire::test('pages::dashboard.costumize-pages');

    foreach (PageContent::pages() as $pageKey => $page) {
        $thirdSection = array_keys($page['sections'])[2];

        $editor
            ->call('selectPage', $pageKey)
            ->call('toggleSection', $thirdSection)
            ->assertSet("sections.{$thirdSection}.enabled", false)
            ->call('save')
            ->assertHasNoErrors();

        expect(PageContent::forPage($pageKey)[$thirdSection]['enabled'])->toBeFalse();
    }
});

it('adds and removes repeatable items', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'doctors')
        ->call('addItem', 'values')
        ->set('sections.values.items.4.title', 'Patient first')
        ->set('sections.values.items.4.description', 'Care starts by listening.')
        ->call('removeItem', 'values', 1)
        ->call('save')
        ->assertHasNoErrors();

    $values = PageContent::forPage('doctors')['values']['items'];

    expect($values)->toHaveCount(4);
    expect(collect($values)->pluck('title')->all())->toContain('Patient first');
    expect(collect($values)->pluck('title')->all())->not->toContain('Continuous Education');
});

it('allows Home Hero statistics to contain fewer than four items', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'home')
        ->call('removeItem', 'hero_stats', 3)
        ->call('save')
        ->assertHasNoErrors();

    $heroStats = PageContent::forPage('home')['hero_stats']['items'];

    expect($heroStats)->toHaveCount(3);
    $this->get('/home')->assertOk()->assertDontSee('Specializations');
});

it('deletes all existing items and does not persist a new item that was removed', function () {
    $existingCount = PageSectionItem::query()
        ->whereHas('section', fn ($query) => $query->where('page_key', 'services')->where('section_key', 'journey'))
        ->count();

    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'services')
        ->call('addItem', 'journey')
        ->set('sections.journey.items.4.title', 'Temporary step')
        ->set('sections.journey.items.4.description', 'This step should not be saved.')
        ->call('removeItem', 'journey', 4)
        ->assertSet('sections.journey.items', fn (array $items) => count($items) === $existingCount)
        ->call('save')
        ->assertHasNoErrors();

    expect(PageSectionItem::query()
        ->whereHas('section', fn ($query) => $query->where('page_key', 'services')->where('section_key', 'journey'))
        ->count())->toBe($existingCount);

    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'contact')
        ->call('removeItem', 'faq', 3)
        ->call('removeItem', 'faq', 2)
        ->call('removeItem', 'faq', 1)
        ->call('removeItem', 'faq', 0)
        ->call('save')
        ->assertHasNoErrors();

    $faqSection = PageSection::query()
        ->where('page_key', 'contact')
        ->where('section_key', 'faq')
        ->firstOrFail();

    expect($faqSection->items()->count())->toBe(0);
    $this->get('/contact')->assertOk()->assertDontSee('Do I need to bring anything to my first visit?');
});

it('saves contact FAQ questions and answers in the database', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'contact')
        ->set('sections.faq.items.0.title', 'How can I prepare?')
        ->set('sections.faq.items.0.description', 'Bring your medical history and arrive early.')
        ->call('save')
        ->assertHasNoErrors();

    $this->get('/contact')
        ->assertOk()
        ->assertSee('How can I prepare?')
        ->assertSee('Bring your medical history and arrive early.');
});

it('stores Heroicon choices and doctor icon colors in the database and renders them', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'about')
        ->set('sections.values.items.0.icon', 'star')
        ->call('save')
        ->assertHasNoErrors();

    $aboutValue = PageSectionItem::query()
        ->whereHas('section', fn ($query) => $query->where('page_key', 'about')->where('section_key', 'values'))
        ->orderBy('sort_order')
        ->firstOrFail();

    expect($aboutValue->icon)->toBe('star');
    $this->get('/about')->assertOk()->assertSee('What We Stand For');

    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'doctors')
        ->set('sections.values.items.0.icon', 'heart')
        ->set('sections.values.items.0.icon_color', '#b91c1c')
        ->call('save')
        ->assertHasNoErrors();

    $doctorValue = PageSectionItem::query()
        ->whereHas('section', fn ($query) => $query->where('page_key', 'doctors')->where('section_key', 'values'))
        ->orderBy('sort_order')
        ->firstOrFail();

    expect($doctorValue->icon)->toBe('heart');
    expect($doctorValue->icon_color)->toBe('#b91c1c');
    $this->get('/doctors')->assertOk()->assertSee('#b91c1c', false);
});

it('edits and renders both home statistics groups from database values', function () {
    Livewire::test('pages::dashboard.costumize-pages')
        ->call('selectPage', 'home')
        ->set('sections.hero_stats.title', 'Our latest results')
        ->set('sections.hero_stats.items.0.title', 'Years helping patients')
        ->set('sections.hero_stats.items.0.value', '18')
        ->set('sections.hero_stats.items.0.suffix', '+')
        ->set('sections.statistics.items.1.title', 'Smiles cared for')
        ->set('sections.statistics.items.1.value', '6200')
        ->set('sections.statistics.items.1.suffix', '+')
        ->call('save')
        ->assertHasNoErrors();

    expect(PageContent::forPage('home')['hero_stats']['title'])->toBe('Our latest results');
    expect(PageContent::forPage('home')['hero_stats']['items'][0]['value'])->toBe('18');
    expect(PageContent::forPage('home')['statistics']['items'][1]['value'])->toBe('6200');

    $this->get('/home')
        ->assertOk()
        ->assertSee('Our latest results')
        ->assertSee('18+')
        ->assertSee('Years helping patients')
        ->assertSee('data-count="6200"', false)
        ->assertSee('Smiles cared for');
});

it('saves section content and visibility to the public page', function () {
    $sections = PageContent::forPage('home');
    $sections['hero']['title'] = "A brighter smile\nStarts today";
    $sections['services']['enabled'] = false;

    PageContent::savePage('home', $sections);

    expect(PageContent::forPage('home')['hero']['title'])->toBe("A brighter smile\nStarts today");
    expect(PageContent::forPage('home')['services']['enabled'])->toBeFalse();

    $this->get('/home')
        ->assertOk()
        ->assertSee('A brighter smile')
        ->assertSee('Starts today')
        ->assertDontSee('Comprehensive Dental Care');
});

it('escapes customized headings when rendering public pages', function () {
    $sections = PageContent::forPage('home');
    $sections['hero']['title'] = '<script>alert(1)</script>';

    PageContent::savePage('home', $sections);

    $this->get('/home')
        ->assertOk()
        ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
        ->assertDontSee('<script>alert(1)</script>', false);
});
