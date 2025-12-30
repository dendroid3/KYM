<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import PaymentPrompt from './PaymentPrompt.vue';
</script>

<template>
    <Card class="w-full max-w-sm">
        <CardHeader>
            <CardTitle
                >Mary Muthoni
                <span class="ml-2 text-green-500"> Verified </span>
            </CardTitle>
        </CardHeader>
        <CardContent>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum
            soluta error natus consequatur, unde praesentium provident
            voluptatem a cupiditate fugiat.
        </CardContent>
        <CardHeader>
            <CardDescription> Experience: 2Yrs </CardDescription>
            <CardDescription> Age Range: 18-20 </CardDescription>
        </CardHeader>
        <CardFooter class="flex flex-col gap-2">
            <PaymentPrompt />
        </CardFooter>
    </Card>
</template>
