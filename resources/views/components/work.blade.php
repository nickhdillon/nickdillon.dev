@php
    $calculate_duration = function (string $date): string {
        $timezone = 'America/Chicago';
    
        $start_date = Carbon\Carbon::parse($date, $timezone);
        $now = Carbon\Carbon::now($timezone);
    
        $total_months = $start_date->diffInMonths($now);
    
        $years = intdiv($total_months, 12);
        $months = $total_months % 12;
    
        return collect([
            $years ? "{$years} " . ($years === 1 ? 'year' : 'years') : null,
            $months ? "{$months} " . ($months === 1 ? 'month' : 'months') : null,
        ])->filter()->implode(' ');
    };

    $work_experience = [
        'gray' => [
            'url' => 'http://graymedia.com/',
            'company' => 'Gray Media',
            'position' => 'Digital Applications Developer',
            'time' => 'April 2023 - Present',
            'duration' => $calculate_duration('2023-04-24'),
            'image' => 'gray-logo.png',
        ],
        'buildOnline' => [
            'url' => 'https://www.buildonline.io',
            'company' => 'Build Online',
            'position' => 'Full Stack Developer',
            'time' => 'Summer 2021',
            'duration' => '2 months',
            'image' => 'build-online.png',
        ],
    ];
@endphp

<div class="mt-32 px-7 sm:mt-40 text-zinc-50">
    <flux:heading class="w-9/12 leading-9 mx-auto !text-[30px] font-medium text-center mb-7">
        My work experience:
    </flux:heading>

    <div class="flex justify-center p-[3.5px] mx-auto border shadow-lg border-zinc-700 rounded-[12px] bg-zinc-800 md:max-w-xl">
        <div class="w-full py-6 pl-10 pr-2 border rounded-[8px] border-zinc-700 inset-shadow-lg text-zinc-50 bg-zinc-900">
            <ul class="relative border-l-2 border-zinc-700 space-y-14">
                @foreach ($work_experience as $work)
                    <li class="ml-6">
                        <span
                            class="absolute flex items-center justify-center w-8 h-8 rounded-full -left-4 ring-8 ring-zinc-800 bg-zinc-800">
                            <img class="shadow-lg" src="{{ asset($work['image']) }}" />
                        </span>

                        <div class="ml-2 sm:grid sm:grid-cols-2 sm:items-center">
                            <div>
                                <a class="duration-200 ease-in-out cursor-pointer hover:text-zinc-400"
                                    href="{{ $work['url'] }}" target="_blank">
                                    <h1 class="text-xl font-medium">
                                        {{ $work['company'] }}
                                    </h1>
                                </a>

                                <h2 class="text-sm">
                                    {{ $work['position'] }}
                                </h2>
                            </div>

                            <div class="flex mt-1 text-xs font-normal sm:flex-col sm:items-center sm:pl-24">
                                <span>{{ $work['time'] }}</span>

                                <span class="block px-1 sm:hidden">•</span>

                                <span>{{ $work['duration'] }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>