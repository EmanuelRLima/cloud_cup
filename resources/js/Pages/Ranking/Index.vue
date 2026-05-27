<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

defineProps({
    ranking: Array,
    userPosition: Object,
});

const currentUserId = usePage().props.auth.user.id;

function medalIcon(pos) {
    if (pos === 1) return '🥇';
    if (pos === 2) return '🥈';
    if (pos === 3) return '🥉';
    return pos;
}
</script>

<template>
    <Head title="Ranking" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">🏆 Ranking Geral</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

                <!-- User's own position card -->
                <div v-if="userPosition" class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-green-700 font-medium">Sua posição</p>
                        <p class="text-2xl font-bold text-green-800">{{ medalIcon(userPosition.position) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ userPosition.total_predictions }} palpites</p>
                        <p class="text-sm text-gray-600">{{ userPosition.exact_scores }} placares exatos</p>
                        <p class="text-xl font-bold text-green-700">{{ userPosition.total_points }} pts</p>
                    </div>
                </div>

                <!-- Ranking table -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Participante</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Palpites</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Exatos</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Resultados</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Pontos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr
                                v-for="entry in ranking" :key="entry.id"
                                :class="entry.id === currentUserId ? 'bg-green-50 font-semibold' : 'hover:bg-gray-50'"
                                class="transition"
                            >
                                <td class="px-4 py-3 text-center text-sm w-12">
                                    <span v-if="entry.position <= 3" class="text-lg">{{ medalIcon(entry.position) }}</span>
                                    <span v-else class="text-gray-500">{{ entry.position }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ entry.name }}
                                    <span v-if="entry.id === currentUserId" class="ml-1 text-xs text-green-600">(você)</span>
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-600">{{ entry.total_predictions }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-sm bg-green-100 text-green-700 px-2 py-0.5 rounded-full">{{ entry.exact_scores }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-sm bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">{{ entry.correct_results }}</span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-green-700 text-sm">
                                    {{ entry.total_points }} pts
                                </td>
                            </tr>
                            <tr v-if="!ranking?.length">
                                <td colspan="6" class="px-4 py-8 text-center text-gray-400 text-sm">
                                    Nenhum palpite registrado ainda.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Legend -->
                <div class="mt-4 flex gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <span class="bg-green-100 text-green-700 px-1.5 py-0.5 rounded">10 pts</span> Placar exato
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded">5 pts</span> Resultado certo
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="bg-red-100 text-red-600 px-1.5 py-0.5 rounded">0 pts</span> Errou
                    </span>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
