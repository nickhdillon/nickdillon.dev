import './bootstrap';

import {
    Alpine,
    Livewire
} from '../../vendor/livewire/livewire/dist/livewire.esm';

import Typewriter from '@marcreichel/alpine-typewriter';

Alpine.plugin(Typewriter);

Livewire.start();
