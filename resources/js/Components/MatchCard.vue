<script setup>
import { router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    match: Object,
});

const homeScore = ref(null);
const awayScore = ref(null);

onMounted(() => {
    if (props.match.user_prediction) {
        homeScore.value = props.match.user_prediction.home_score ?? null;
        awayScore.value = props.match.user_prediction.away_score ?? null;
    }
});

const isSet = (v) => v !== null && v !== '' && v !== undefined;

function submit() {
    if (!isSet(homeScore.value) || !isSet(awayScore.value)) return;
    router.post(route('predictions.upsert', props.match.id), {
        home_score: Number(homeScore.value),
        away_score: Number(awayScore.value),
    }, { preserveScroll: true });
}

function teamName(team, placeholder) {
    if (team) return `${team.flag_emoji ?? ''} ${team.name}`;
    return placeholder ?? 'A definir';
}

function pointsClass(points) {
    if (points === 10) return 'bg-green-100 text-green-700 font-bold';
    if (points === 5) return 'bg-blue-100 text-blue-700 font-bold';
    if (points === 0) return 'bg-red-100 text-red-600';
    return '';
}

function pointsLabel(points) {
    if (points === 10) return '+10 pts';
    if (points === 5) return '+5 pts';
    if (points === 0) return '0 pts';
    return null;
}

const canPredict = () =>
    props.match.status === 'scheduled' &&
    props.match.home_team_id !== null &&
    props.match.away_team_id !== null;
</script>

<template>
    <div
        class="rounded-xl border p-4 shadow-sm transition"
        :class="{
            'bg-white': match.status === 'scheduled',
            'bg-red-50 border-red-200': match.status === 'live',
            'bg-gray-50': match.status === 'finished',
        }"
    >
        <!-- Status badge -->
        <div class="flex justify-between items-center mb-3">
            <span class="text-xs font-medium px-2 py-0.5 rounded-full"
                :class="{
                    'bg-yellow-100 text-yellow-700': match.status === 'scheduled',
                    'bg-red-100 text-red-700 animate-pulse': match.status === 'live',
                    'bg-gray-200 text-gray-600': match.status === 'finished',
                }"
            >
                {{ match.status === 'live' ? '🔴 Ao vivo' : match.status === 'finished' ? '✅ Encerrado' : '🕐 Aguardando' }}
            </span>
            <span v-if="match.scheduled_at" class="text-xs text-gray-400">
                {{ new Date(match.scheduled_at).toLocaleString('pt-BR', { timeZone: 'America/Sao_Paulo', day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) }}
            </span>
        </div>

        <!-- Teams & Score -->
        <div class="flex items-center justify-between gap-2 mb-4">
            <span class="flex-1 text-sm font-semibold text-gray-800 text-right leading-tight">
                {{ teamName(match.home_team, match.home_placeholder) }}
            </span>

            <!-- Official result or live score -->
            <div class="flex items-center gap-1 shrink-0">
                <template v-if="match.status === 'finished' || match.status === 'live'">
                    <span class="text-xl font-bold text-gray-900">{{ match.home_score }}</span>
                    <span class="text-gray-400 font-bold">×</span>
                    <span class="text-xl font-bold text-gray-900">{{ match.away_score }}</span>
                </template>
                <template v-else>
                    <span class="text-gray-300 font-bold text-lg">vs</span>
                </template>
            </div>

            <span class="flex-1 text-sm font-semibold text-gray-800 leading-tight">
                {{ teamName(match.away_team, match.away_placeholder) }}
            </span>
        </div>

        <!-- User prediction display (after match finished) -->
        <div v-if="match.status === 'finished' && match.user_prediction" class="mb-3 text-center">
            <span class="text-xs text-gray-500">Seu palpite: </span>
            <span class="text-sm font-semibold">
                {{ match.user_prediction.home_score }} × {{ match.user_prediction.away_score }}
            </span>
            <span
                v-if="match.user_prediction.points !== null"
                class="ml-2 text-xs px-2 py-0.5 rounded-full"
                :class="pointsClass(match.user_prediction.points)"
            >
                {{ pointsLabel(match.user_prediction.points) }}
            </span>
        </div>

        <div v-else-if="match.status === 'finished' && !match.user_prediction"
            class="mb-3 text-center text-xs text-gray-400">
            Sem palpite registrado
        </div>

        <!-- Prediction input (only when scheduleable) -->
        <div v-if="canPredict()" class="mt-2">
            <p class="text-xs text-center text-gray-500 mb-2">Seu palpite</p>
            <div class="flex items-center justify-center gap-2">
                <input
                    v-model="homeScore"
                    type="number" min="0" max="30"
                    class="w-14 text-center border rounded-lg py-1.5 text-lg font-bold focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="0"
                />
                <span class="text-gray-400 font-bold">×</span>
                <input
                    v-model="awayScore"
                    type="number" min="0" max="30"
                    class="w-14 text-center border rounded-lg py-1.5 text-lg font-bold focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="0"
                />
            </div>
            <button
                @click="submit"
                :disabled="!isSet(homeScore) || !isSet(awayScore)"
                class="mt-3 w-full py-1.5 rounded-lg text-sm font-semibold transition"
                :class="isSet(homeScore) && isSet(awayScore)
                    ? 'bg-green-600 text-white hover:bg-green-700'
                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'"
            >
                {{ match.user_prediction ? 'Atualizar Palpite' : 'Salvar Palpite' }}
            </button>
        </div>
    </div>
</template>
