<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MatchCard from '@/Components/MatchCard.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    groups: Array,
    knockout: Object,
});

const activeTab = ref('groups');
const activeGroup = ref('A');

const stageLabels = {
    r32: '32 Avos',
    r16: '16 Avos',
    qf: 'Quartas',
    sf: 'Semifinal',
    '3rd': '3º Lugar',
    final: 'Final',
};
</script>

<template>
    <Head title="Partidas" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">⚽ Partidas da Copa 2026</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <!-- Stage tabs -->
                <div class="mb-6 flex gap-2 flex-wrap">
                    <button
                        @click="activeTab = 'groups'"
                        :class="activeTab === 'groups' ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                        class="px-4 py-2 rounded-full text-sm font-medium border transition"
                    >
                        Fase de Grupos
                    </button>
                    <button
                        v-for="(label, key) in stageLabels" :key="key"
                        @click="activeTab = key"
                        :class="activeTab === key ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                        class="px-4 py-2 rounded-full text-sm font-medium border transition"
                    >
                        {{ label }}
                    </button>
                </div>

                <!-- Group Stage -->
                <div v-if="activeTab === 'groups'">
                    <!-- Group tabs -->
                    <div class="mb-4 flex gap-1 flex-wrap">
                        <button
                            v-for="group in groups" :key="group.name"
                            @click="activeGroup = group.name"
                            :class="activeGroup === group.name ? 'bg-green-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                            class="w-9 h-9 rounded-full text-sm font-bold border transition"
                        >
                            {{ group.name }}
                        </button>
                    </div>

                    <div v-for="group in groups" :key="group.id" v-show="activeGroup === group.name">
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Grupo {{ group.name }}</h3>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span v-for="team in group.teams" :key="team.id"
                                    class="text-sm bg-gray-100 px-2 py-1 rounded-full">
                                    {{ team.flag_emoji }} {{ team.name }}
                                </span>
                            </div>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                            <MatchCard
                                v-for="match in group.matches" :key="match.id"
                                :match="match"
                            />
                        </div>
                    </div>
                </div>

                <!-- Knockout stages -->
                <template v-for="(label, key) in stageLabels" :key="key">
                    <div v-show="activeTab === key">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">{{ label }}</h3>
                        <div v-if="knockout[key]?.length" class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                            <MatchCard
                                v-for="match in knockout[key]" :key="match.id"
                                :match="match"
                            />
                        </div>
                        <p v-else class="text-gray-400 text-sm">Partidas ainda não definidas.</p>
                    </div>
                </template>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
