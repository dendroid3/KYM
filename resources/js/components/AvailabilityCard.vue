<script lang="js" setup>
import { Button } from '@/components/ui/button';
const props = defineProps(['available']);
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content')

</script>
<template>
    <div class="rounded bg-black bg-orange-800 p-1 p-2 text-white">
        <section>
            <p class="text-center text-lg font-bold uppercase">
                You are VERIFIED
            </p>
        </section>
        <section v-if="available">
            <p>
                You are marked as
                <strong class="text-green-500 rounded bg-white px-1"> available.</strong> This means
                that your profile appears when prospect employers search for
                house helps. If you are no longer available for work, kindly
                change your status below
            </p>
        </section>
        <section v-else>
            <p>
                You are marked as
                <strong class="text-red-500 rounded bg-white px-1">unavailable.</strong> This means
                that your profile appears when prospect employers search for
                house helps. If you are no longer available for work, kindly
                change your status below
            </p>
        </section>
        <form class="text-center" method="POST" action="change_availability">
            <input type="hidden" name="_token" :value="csrfToken">
            <Button type="submit" class="bg-green-500"> Change Status </Button>
        </form>
    </div>
</template>
