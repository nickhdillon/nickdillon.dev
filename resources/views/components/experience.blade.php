@php
    use Carbon\Carbon;

    $timezone = 'America/Chicago';

    $calculate_duration = function (string $start, ?string $end = null) use ($timezone): string {    
        $start_date = Carbon::parse($start, $timezone);
        $end_date = $end ? Carbon::parse($end, $timezone) : Carbon::now($timezone);

        $diff = $start_date->diff($end_date);

        $years = $diff->y;
        $months = $diff->m;
    
        return collect([
            $years ? "{$years} " . ($years === 1 ? 'year' : 'yrs') : null,
            $months ? "{$months} " . ($months === 1 ? 'month' : 'mos') : null,
        ])->filter()->implode(' ');
    };

    $experiences = [
        [
            'url' => 'http://graymedia.com/',
            'company' => 'Gray Media',
            'image' => 'gray-logo.png',
            'positions' => [
                [
                    'title' => 'Associate Software Developer',
                    'time' => 'Oct 2025 - Present',
                    'start_date' => '2025-10-20',
                    'end_date' => null,
                    'duration' => $calculate_duration('2025-10-20'),
                ],
                [
                    'title' => 'Digital Applications Developer',
                    'time' => 'Apr 2023 - Oct 2025',
                    'start_date' => '2023-04-24',
                    'end_date' => '2025-10-19',
                    'duration' => $calculate_duration('2023-04-24', '2025-10-19'),
                ]
            ],
        ],
        [
            'url' => 'https://www.buildonline.io',
            'company' => 'Build Online',
            'image' => 'build-online.png',
            'positions' => [
                [
                    'title' => 'Full Stack Developer',
                    'time' => 'May 2021 - Jul 2021',
                    'start_date' => '2021-05-01',
                    'end_date' => '2021-07-01',
                    'duration' => $calculate_duration('2021-05-01', '2021-07-01'),
                ],
            ],
        ],
    ];

    $experiences = collect($experiences)
        ->map(function (array $experience) use ($calculate_duration, $timezone): array {
            $start_dates = collect($experience['positions'])
                ->pluck('start_date')
                ->map(fn(string $date): Carbon => Carbon::parse($date, $timezone));

            $end_dates = collect($experience['positions'])
                ->pluck('end_date')
                ->map(function (?string $date) use ($timezone): Carbon {
                    return $date ? Carbon::parse($date, $timezone) : Carbon::now($timezone);
                });

            $earliest = $start_dates->min();
            $latest = $end_dates->max();

            $experience['total_duration'] = $calculate_duration($earliest, $latest);

            return $experience;
        });
@endphp

<div id="experience" class="mt-32 px-7 sm:mt-40 text-zinc-50 scroll-mt-24">
    <flux:heading class="w-9/12 leading-9 mx-auto text-[20px]! font-medium text-center mb-7">
        Experience
    </flux:heading>

    <div class="flex justify-center p-[3.5px] mx-auto border shadow-lg border-zinc-600 bg-zinc-800 md:max-w-xl">
        <div class="w-full p-5 pr-2 border border-zinc-600 inset-shadow-lg text-zinc-50 bg-zinc-900">
            <ul class="space-y-8 flex flex-col">
                @foreach ($experiences as $experience)
                    <li>
                        <div class="flex items-center">
                            <flux:avatar src="{{ asset($experience['image']) }}"
                                class="p-2 bg-zinc-800 after:inset-ring-[1.5px]! after:inset-ring-zinc-600!" />

                            <div class="flex pl-4 -space-y-1 flex-col">
                                <a class="duration-200 ease-in-out cursor-pointer hover:text-zinc-400"
                                    href="{{ $experience['url'] }}" target="_blank">
                                    <h1 class="text-md font-medium">
                                        {{ $experience['company'] }}
                                    </h1>
                                </a>

                                @if (count($experience['positions']) === 1)   
                                    <h2 class="text-xs sm:text-sm">
                                        {{ $experience['positions'][0]['title'] }}
                                    </h2>
                                @else
                                    <h2 class="text-xs sm:text-sm">
                                        {{ $experience['total_duration'] }}
                                    </h2>
                                @endif
                            </div>
                        </div>

                        <div class="font-normal -mt-1 sm:mt-auto text-white/70 text-[11px] sm:text-xs -tracking-[0.01em] sm:tracking-normal pl-14">
                            @if (count($experience['positions']) === 1)
                                <p>
                                    {{ $experience['positions'][0]['time'] }}
                                    <span>•</span>
                                    {{ $experience['total_duration'] }}
                                </p>
                            @endif
                        </div>

                        @if (count($experience['positions']) > 1) 
                            <div class="pl-5 mt-3 flex flex-col space-y-5">
                                <flux:timeline
                                    class="[--flux-timeline-item-gap:1.5rem] [--flux-timeline-content-gap:2.1rem] sm:[--flux-timeline-content-gap:2rem]"
                                    align="start"
                                >
                                    @foreach ($experience['positions'] as $position)
                                        <flux:timeline.item size="sm" class="-ml-0.5">
                                            <flux:timeline.indicator variant="bare">
                                                <div class="size-1.5 rounded-full bg-zinc-400"></div>
                                            </flux:timeline.indicator>

                                            <flux:timeline.content>
                                                <flux:text class="text-zinc-50 text-xs sm:text-sm -tracking-[0.01em] sm:tracking-normal">
                                                    {{ $position['title'] }}
                                                </flux:text>

                                                <flux:text class="text-[11px] sm:text-xs -tracking-[0.01em] sm:tracking-normal">
                                                    {{ $position['time'] }}

                                                    @if ($position['duration'])
                                                        <span>•</span>
                                                    @endif

                                                    {{ $position['duration'] }}
                                                </flux:text>
                                            </flux:timeline.content>
                                        </flux:timeline.item>
                                    @endforeach
                                </flux:timeline>
                            </div>                     
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>