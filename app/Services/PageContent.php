<?php

namespace App\Services;

use App\Models\PageSection;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PageContent
{
    public static function icons(): array
    {
        return [
            'shield-check' => 'Shield check',
            'heart' => 'Heart',
            'chart-bar' => 'Chart bar',
            'clock' => 'Clock',
            'user-group' => 'User group',
            'book-open' => 'Book open',
            'check-badge' => 'Check badge',
            'calendar-days' => 'Calendar',
            'stethoscope' => 'Stethoscope',
            'heart-pulse' => 'Heart pulse',
            'sparkles' => 'Sparkles',
            'star' => 'Star',
            'arrow-up' => 'Arrow up',
            'arrow-down' => 'Arrow down',
            'trash' => 'Trash',
            'plus' => 'Plus',
            'check' => 'Check',
            'x-mark' => 'Close',
            'sun' => 'Sun',
            'moon' => 'Moon',
            'home' => 'Home',
            'briefcase' => 'Briefcase',
            'chat-bubble-left-right' => 'Messages',
            'question-mark-circle' => 'Help',
            'rectangle-stack' => 'Sections',
            'arrow-top-right-on-square' => 'Open in new tab',
            'bookmark' => 'Save',
            'arrow-path' => 'Loading',
            'document-text' => 'Document',
        ];
    }

    public static function definitions(): array
    {
        return [
            'home' => [
                'label' => 'Home',
                'route' => 'guest.home',
                'sections' => [
                    'hero' => self::section('Hero', "Healthy Smiles\n", 'Advanced dental care for adults and children in a comfortable, modern environment. Experience dentistry that puts you first.'),
                    'hero_stats' => self::section('Hero statistics', 'Our Results at a Glance', '', [
                        self::stat('Years of Excellence', '15', '+'),
                        self::stat('Happy Patients', '5000', '+'),
                        self::stat('Average Rating', '4.9', '★'),
                        self::stat('Specializations', '6'),
                    ]),
                    'statistics' => self::section('Home statistics', 'Clinic Statistics', '', [
                        self::stat('Years Experience', '15', '+'),
                        self::stat('Patients Treated', '5000', '+'),
                        self::stat('Patient Rating', '4.9', '/5'),
                        self::stat('Specialized Services', '6'),
                    ]),
                    'services' => self::section('Our test services', 'Comprehensive Dental Care', 'From routine checkups to advanced cosmetic procedures, we offer a full range of dental services designed for every need and budget.'),
                    'why' => self::section('Why choose us', "Care You Can\nAlways Trust", 'We combine years of experience with the latest technology and a patient-first approach to deliver outstanding dental outcomes.'),
                    'cases' => self::section('Before & after', 'Before & After', 'See the transformative difference our treatments make for our patients.'),
                    'team' => self::section('Our team', 'Meet Our Specialists', 'A dedicated team of board-certified dentists committed to your smile and well-being.'),
                    'testimonials' => self::section('Testimonials', 'What Our Patients Say', "Don't take our word for it — hear from the patients whose smiles we've transformed."),
                    'journey' => self::section('Patient journey', 'Your Journey to a Better Smile', 'Four simple steps from your first contact to a confident, healthy smile.'),
                    'faq' => self::section('Frequently asked questions', 'Frequently Asked Questions', "Have a question? We've got answers to the most common queries from our patients."),
                    'cta' => self::section('Call to action', 'Ready for a Healthier Smile?', 'Join over 5,000 patients who trust Nova Dental Clinic for their oral health. Book your consultation today.'),
                ],
            ],
            'services' => [
                'label' => 'Services',
                'route' => 'guest.service',
                'sections' => [
                    'hero' => self::section('Hero', 'Our Dental Services', 'Comprehensive, transparent dental care with upfront pricing. From your first checkup to cosmetic transformations — we have you covered.'),
                    'offers' => self::section('What we offer', 'What We Offer', 'Every service is delivered by board-certified specialists using the latest technology and evidence-based techniques.'),
                    'journey' => self::section('Your Patient Journey', 'Your Patient Journey', 'A seamless experience from booking to follow-up care.', [
                        self::item('Book', 'Call, visit, or book online. We confirm within 30 minutes.', 'calendar-days'),
                        self::item('Consult', 'Meet your specialist, get examined, and receive a custom plan.', 'stethoscope'),
                        self::item('Treatment', 'Receive world-class care in our modern, safe environment.', 'heart-pulse'),
                        self::item('Follow Up', 'We monitor your progress and are here whenever you need us.', 'calendar-days'),
                    ]),
                    'cta' => self::section('Call to action', 'Not Sure Which Service You Need?', 'Start with a consultation. Our specialists will assess your oral health and recommend the best treatment plan for your specific needs and budget.'),
                ],
            ],
            'doctors' => [
                'label' => 'Doctors',
                'route' => 'guest.doctor',
                'sections' => [
                    'hero' => self::section('Hero', 'Meet Our Specialists', 'A team of passionate, board-certified dental professionals dedicated to providing exceptional care and beautiful results.'),
                    'team' => self::section('Our team', 'Expertise You Can Trust', 'Every doctor at Nova Dental holds an advanced degree, ongoing training, and a genuine commitment to patient well-being.'),
                    'values' => self::section('Our Commitment', 'The Standards We Hold Ourselves To', '', [
                        self::item('Patient Safety First', 'All procedures follow strict sterilization and safety protocols.', 'shield-check', '#16a34a'),
                        self::item('Continuous Education', 'Our team attends international conferences and training annually.', 'book-open', '#2563eb'),
                        self::item('Evidence-Based Care', 'Every recommendation is grounded in the latest dental research.', 'check-badge', '#7c3aed'),
                        self::item('Compassionate Care', 'We treat every patient with empathy, respect, and understanding.', 'heart'),
                    ]),
                    'cta' => self::section('Call to action', 'Ready to Meet Your Specialist?', 'Book a consultation with any of our doctors and take the first step toward a healthier, more confident smile.'),
                ],
            ],
            'contact' => [
                'label' => 'Contact us',
                'route' => 'guest.contact',
                'sections' => [
                    'hero' => self::section('Hero', 'Get in Touch', "Ready to start your smile journey? Book a consultation or reach out to us — we'd love to hear from you."),
                    'contact' => self::section('Contact information', 'Contact Information', "We're here to help. Reach us by phone, email, or visit us in clinic."),
                    'faq' => self::section('Common Questions', 'Common Questions', '', [
                        self::item('Do I need to bring anything to my first visit?', "For your first visit, simply bring a valid ID. If you have previous dental X-rays or medical records, they can be helpful but are not required. We'll perform our own comprehensive examination and digital X-rays."),
                        self::item('How early should I arrive for my appointment?', 'We recommend arriving 10 minutes before your scheduled appointment to complete a brief intake form. For new patients, 15 minutes early is ideal so we can review your dental history.'),
                        self::item('What payment methods do you accept?', 'We accept cash, CIB card, and bank transfers (virement bancaire). For larger procedures such as implants, we offer flexible payment arrangements — please ask at reception about our installment plans.'),
                        self::item('Can I cancel or reschedule my appointment?', 'Yes. We ask that you notify us at least 24 hours in advance if you need to cancel or reschedule. You can call us directly or send an email and we will accommodate you as best we can.'),
                    ]),
                    'cta' => self::section('Call to action', "We Can't Wait to Meet You", "Whether you're coming in for a routine checkup or a smile transformation, Nova Dental Clinic is here for you every step of the way."),
                ],
            ],
            'about' => [
                'label' => 'About us',
                'route' => 'guest.about',
                'sections' => [
                    'hero' => self::section('Hero', 'About Nova Dental', 'A decade of smiles, trust, and unwavering commitment to the highest standards in dental care.'),
                    'story' => self::section('Our story', "Modern Dentistry\nFor Modern Families", ''),
                    'values' => self::section('What We Stand For', 'What We Stand For', 'Our values guide every decision, every procedure, and every patient interaction.', [
                        self::item('Safety', 'Hospital-grade sterilization, ISO-certified protocols, and a zero-compromise attitude toward patient safety.', 'shield-check'),
                        self::item('Compassion', 'We listen, we understand, and we tailor every experience to make you feel comfortable and cared for.', 'heart'),
                        self::item('Excellence', 'We continuously invest in training and technology to deliver outcomes that meet international standards.', 'chart-bar'),
                        self::item('Transparency', 'Honest pricing, clear treatment plans, and open communication — no surprises, ever.', 'clock'),
                        self::item('Community', 'We are proud to serve Algerian families and are committed to improving oral health across our community.', 'user-group'),
                        self::item('Innovation', 'From digital impressions to 3D implant planning, we embrace technology that improves outcomes for patients.', 'book-open'),
                    ]),
                    'milestones' => self::section('Our milestones', '15 Years of Growth', ''),
                    'cta' => self::section('Call to action', 'Become Part of Our Story', "Join thousands of patients who have trusted Nova Dental Clinic for their oral health journey. We'd love to welcome you."),
                ],
            ],
        ];
    }

    public static function pages(): array
    {
        return self::definitions();
    }

    public static function forPage(string $page): array
    {
        $pages = self::definitions();

        if (! isset($pages[$page])) {
            throw new RuntimeException("The page [{$page}] is not available for customization.");
        }

        $sections = PageSection::query()
            ->where('page_key', $page)
            ->with('items')
            ->get()
            ->keyBy('section_key');

        foreach ($pages[$page]['sections'] as $key => $section) {
            $stored = $sections->get($key);

            if (! $stored) {
                continue;
            }

            $storedSection = [
                'label' => $stored->label,
                'title' => $stored->title,
                'description' => $stored->description ?? '',
                'enabled' => $stored->enabled,
            ];

            if (isset($section['items'])) {
                $storedSection['items'] = $stored->items->map(fn ($item) => [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description ?? '',
                    'value' => $item->value ?? '',
                    'suffix' => $item->suffix ?? '',
                    'icon' => self::normalizedIcon($item->icon),
                    'icon_color' => $item->icon_color ?? '#2563eb',
                ])->all();
            }

            $pages[$page]['sections'][$key] = $storedSection;
        }

        return $pages[$page]['sections'];
    }

    public static function savePage(string $page, array $sections): void
    {
        $definitions = self::definitions();

        if (! isset($definitions[$page])) {
            throw new RuntimeException("The page [{$page}] is not available for customization.");
        }

        DB::transaction(function () use ($definitions, $page, $sections): void {
            foreach ($definitions[$page]['sections'] as $key => $defaults) {
                $submitted = $sections[$key] ?? [];
                $section = PageSection::query()->updateOrCreate(
                    ['page_key' => $page, 'section_key' => $key],
                    [
                        'label' => $defaults['label'],
                        'title' => $submitted['title'] ?? $defaults['title'],
                        'description' => $submitted['description'] ?? $defaults['description'],
                        'enabled' => $submitted['enabled'] ?? $defaults['enabled'],
                    ],
                );

                if (! array_key_exists('items', $defaults)) {
                    continue;
                }

                $existingItems = $section->items()->get()->keyBy('id');
                $retainedIds = [];

                foreach (array_values($submitted['items'] ?? []) as $index => $item) {
                    $itemId = isset($item['id']) ? (int) $item['id'] : null;
                    $existing = $itemId ? $existingItems->get($itemId) : null;

                    if ($itemId && ! $existing) {
                        throw new RuntimeException('A page item no longer belongs to this section. Refresh and try again.');
                    }

                    $attributes = [
                        'title' => $item['title'],
                        'description' => $item['description'] ?? '',
                        'value' => $item['value'] ?? null,
                        'suffix' => $item['suffix'] ?? null,
                        'sort_order' => $index,
                    ];

                    if (($page === 'doctors' || $page === 'about') && $key === 'values') {
                        $attributes['icon'] = self::normalizedIcon($item['icon'] ?? null);
                    }

                    if ($page === 'doctors' && $key === 'values') {
                        $attributes['icon_color'] = $item['icon_color'] ?? '#2563eb';
                    }

                    if ($existing) {
                        $existing->update($attributes);
                        $retainedIds[] = $existing->id;
                    } else {
                        $newItem = $section->items()->create([
                            ...$attributes,
                            'icon' => self::normalizedIcon($item['icon'] ?? null),
                            'icon_color' => $item['icon_color'] ?? null,
                        ]);
                        $retainedIds[] = $newItem->id;
                    }
                }

                $section->items()
                    ->when($retainedIds !== [], fn ($query) => $query->whereNotIn('id', $retainedIds))
                    ->delete();
            }
        });
    }

    private static function section(string $label, string $title, string $description, ?array $items = null): array
    {
        $section = [
            'label' => $label,
            'title' => $title,
            'description' => $description,
            'enabled' => true,
        ];

        if ($items !== null) {
            $section['items'] = $items;
        }

        return $section;
    }

    private static function item(string $title, string $description, ?string $icon = null, ?string $iconColor = null): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'value' => null,
            'suffix' => '',
            'icon' => self::normalizedIcon($icon),
            'icon_color' => $iconColor,
        ];
    }

    private static function stat(string $label, string $value, string $suffix = ''): array
    {
        return [
            'title' => $label,
            'description' => '',
            'value' => $value,
            'suffix' => $suffix,
            'icon' => null,
            'icon_color' => null,
        ];
    }

    private static function normalizedIcon(?string $icon): string
    {
        $aliases = [
            'shield' => 'shield-check',
            'book' => 'book-open',
            'circle-check' => 'check-badge',
            'activity' => 'chart-bar',
            'calendar' => 'calendar-days',
            'calendar-check' => 'calendar-days',
        ];
        $icon = $aliases[$icon ?? ''] ?? $icon;

        return is_string($icon) && isset(self::icons()[$icon]) ? $icon : 'sparkles';
    }
}
