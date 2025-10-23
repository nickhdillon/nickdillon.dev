@php
    use Carbon\Carbon;

    $timezone = 'America/Chicago';

    $calculate_duration = function (string $start, ?string $end = null) use ($timezone): string {    
        $start_date = Carbon::parse($start, $timezone);
        $end_date = $end ? Carbon::parse($end, $timezone) : Carbon::now($timezone);

        $months = $start_date->diffInMonths($end_date);

        $years = intdiv($months, 12);

        $months = $months % 12;
    
        return collect([
            $years ? "{$years} " . ($years === 1 ? 'year' : 'yrs') : null,
            $months ? "{$months} " . ($months === 1 ? 'month' : 'mos') : null,
        ])->filter()->implode(' ');
    };

    $work_experience = [
        [
            'url' => 'http://graymedia.com/',
            'company' => 'Gray Media',
            'image' => 'gray-logo.png',
            'positions' => [
                [
                    'title' => 'Associate Software Developer',
                    'time' => 'October 2025 - Present',
                    'start_date' => '2025-10-20',
                    'end_date' => null,
                    'duration' => $calculate_duration('2025-10-20'),
                ],
                [
                    'title' => 'Digital Applications Developer',
                    'time' => 'April 2023 - October 2025',
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
                    'time' => 'May 2021 - July 2021',
                    'start_date' => '2021-05-01',
                    'end_date' => '2021-07-01',
                    'duration' => $calculate_duration('2021-05-01', '2021-07-01'),
                ],
            ],
        ],
    ];

    $work_experience = collect($work_experience)
        ->map(function (array $work) use ($calculate_duration, $timezone): array {
            $start_dates = collect($work['positions'])
                ->pluck('start_date')
                ->map(fn(string $date): Carbon => Carbon::parse($date, $timezone));

            $end_dates = collect($work['positions'])
                ->pluck('end_date')
                ->map(function (?string $date) use ($timezone): Carbon {
                    return $date ? Carbon::parse($date, $timezone) : Carbon::now($timezone);
                });

            $earliest = $start_dates->min();
            $latest = $end_dates->max();

            $work['total_duration'] = $calculate_duration($earliest, $latest);

            return $work;
        });
@endphp

<div class="mt-32 px-7 sm:mt-40 text-zinc-50">
    <flux:heading class="w-9/12 leading-9 mx-auto !text-[30px] font-medium text-center mb-7">
        My work experience:
    </flux:heading>

    <div class="flex justify-center p-[3.5px] mx-auto border shadow-lg border-zinc-700 rounded-[12px] bg-zinc-800 md:max-w-xl">
        <div class="w-full p-5 pr-2 border rounded-[8px] border-zinc-700 inset-shadow-lg text-zinc-50 bg-zinc-900">
            <ul class="space-y-8 flex flex-col">
                @foreach ($work_experience as $work)
                    <li>
                        <div class="flex items-center">
                            <flux:avatar src="{{ asset($work['image']) }}"
                                class="p-2 bg-zinc-800 after:inset-ring-[1.5px]! after:inset-ring-zinc-700!" />

                            <div class="flex pl-4 -space-y-1 flex-col">
                                <a class="duration-200 ease-in-out cursor-pointer hover:text-zinc-400"
                                    href="{{ $work['url'] }}" target="_blank">
                                    <h1 class="text-lg font-medium">
                                        {{ $work['company'] }}
                                    </h1>
                                </a>

                                @if (count($work['positions']) === 1)   
                                    <h2 class="text-sm">
                                        {{ $work['positions'][0]['title'] }}
                                    </h2>
                                @else
                                    <h2 class="text-sm">
                                        {{ $work['total_duration'] }}
                                    </h2>
                                @endif
                            </div>
                        </div>

                        <div class="font-normal text-zinc-400 text-xs pl-14">
                            @if (count($work['positions']) === 1)
                                <p>
                                    {{ $work['positions'][0]['time'] }}
                                    <span>•</span>
                                    {{ $work['total_duration'] }}
                                </p>
                            @endif
                        </div>

                        @if (count($work['positions']) > 1) 
                            <div class="pl-5 mt-3 flex flex-col space-y-5">
                                @foreach ($work['positions'] as $position)
                                    <div class="relative flex items-start pl-5">
                                        @if (! $loop->last)
                                            <span class="absolute left-[0.5px] sm:left-[0.24px] top-[1em] bottom-[-1.3em] w-[1.5px] bg-zinc-700"></span>
                                        @endif
                            
                                        <span class="absolute -left-[2px] top-[0.5em] -translate-y-1/2 size-1.5 rounded-full bg-zinc-400"></span>
                            
                                        <div class="ml-4 text-sm flex flex-col">
                                            <h2 class="leading-tight">{{ $position['title'] }}</h2>
                            
                                            <p class="text-xs text-zinc-400 mt-0.5">
                                                {{ $position['time'] }}

                                                @if ($position['duration'])
                                                    <span>•</span>
                                                @endif

                                                {{ $position['duration'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>                     
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>