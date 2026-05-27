<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({ matches: Array });

const editing = ref(null);
const form = ref({});

const stageLabels = {
    group: 'Grupos', r32: '32 Avos', r16: '16 Avos',
    qf: 'Quartas', sf: 'Semifinal', '3rd': '3º Lugar', final: 'Final',
};

function startEdit(match) {
    editing.value = match.id;
    form.value = {
        home_score: match.home_score ?? '',
        away_score: match.away_score ?? '',
        home_score_et: match.home_score_et ?? '',
        away_score_et: match.away_score_et ?? '',
        home_penalties: match.home_penalties ?? '',
        away_penalties: match.away_penalties ?? '',
        status: match.status,
    };
}

function saveResult(match) {
    router.patch(route('admin.matches.update', match.id), form.value, {
        preserveScroll: true,
        onSuccess: () => { editing.value = null; },
    });
}

function teamLabel(match, side) {
    const team = side === 'home' ? match.home_team : match.away_team;
    const placeholder = side === 'home' ? match.home_placeholder : match.away_placeholder;
    if (team) return `${team.flag_emoji ?? ''} ${team.name}`;
    return placeholder ?? 'A definir';
}
</script>

<template>
    <Head title="Admin - Partidas" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">⚙️ Admin — Resultados das Partidas</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Fase</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Partida</th>
                                <th class="px-3 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Placar</th>
                                <th class="px-3 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="px-3 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template v-for="match in matches" :key="match.id">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-3 text-gray-400">{{ match.match_number }}</td>
                                    <td class="px-3 py-3">
                                        <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full">{{ stageLabels[match.stage] }}</span>
                                    </td>
                                    <td class="px-3 py-3 font-medium">
                                        {{ teamLabel(match, 'home') }} × {{ teamLabel(match, 'away') }}
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <span v-if="match.status !== 'scheduled'" class="font-bold">
                                            {{ match.home_score }} × {{ match.away_score }}
                                        </span>
                                        <span v-else class="text-gray-300">—</span>
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="text-xs px-2 py-0.5 rounded-full"
                                            :class="{
                                                'bg-yellow-100 text-yellow-700': match.status === 'scheduled',
                                                'bg-red-100 text-red-700': match.status === 'live',
                                                'bg-green-100 text-green-700': match.status === 'finished',
                                            }">
                                            {{ match.status }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 text-right">
                                        <button @click="startEdit(match)"
                                            class="text-xs text-blue-600 hover:underline">
                                            Editar
                                        </button>
                                    </td>
                                </tr>

                                <!-- Inline edit form -->
                                <tr v-if="editing === match.id" class="bg-blue-50">
                                    <td colspan="6" class="px-4 py-4">
                                        <div class="flex flex-wrap gap-3 items-end">
                                            <div>
                                                <label class="text-xs text-gray-600 block mb-1">Placar ({{ teamLabel(match, 'home') }})</label>
                                                <input v-model="form.home_score" type="number" min="0"
                                                    class="w-16 border rounded px-2 py-1 text-center" />
                                            </div>
                                            <span class="text-gray-400 pb-1">×</span>
                                            <div>
                                                <label class="text-xs text-gray-600 block mb-1">Placar ({{ teamLabel(match, 'away') }})</label>
                                                <input v-model="form.away_score" type="number" min="0"
                                                    class="w-16 border rounded px-2 py-1 text-center" />
                                            </div>
                                            <div>
                                                <label class="text-xs text-gray-600 block mb-1">Status</label>
                                                <select v-model="form.status" class="border rounded px-2 py-1 text-sm">
                                                    <option value="scheduled">scheduled</option>
                                                    <option value="live">live</option>
                                                    <option value="finished">finished</option>
                                                </select>
                                            </div>
                                            <button @click="saveResult(match)"
                                                class="bg-green-600 text-white px-3 py-1.5 rounded text-sm hover:bg-green-700">
                                                Salvar
                                            </button>
                                            <button @click="editing = null"
                                                class="text-gray-500 text-sm hover:underline">
                                                Cancelar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
