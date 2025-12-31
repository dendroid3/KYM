<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content');
</script>

<template>
    <Dialog>
        <form method="POST" action="initialize_payment">
            <!-- <DialogTrigger as-child>
                <Button class="w-full bg-blue-500 text-white">
                    Unlock Contact
                </Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[425px]">
                <DialogHeader>
                    <DialogTitle>Pay to Unlock</DialogTitle>
                    <DialogDescription>
                        Payment grants access to contact details only. It does
                        not guarantee availability, agreement, or employment.
                    </DialogDescription>
                    <DialogDescription>
                        Enter MPesa number to pay KES X. The prompt will be sent
                        with the hakikisha name: "Some Name"
                        {{ csrfToken }}
                    </DialogDescription>
                </DialogHeader>
                <div class="grid gap-4">
                    <div class="grid gap-3">
                        <Label for="name-1">MPesa Number</Label>
                        <Input
                            id="phone_number"
                            name="phone_number"
                            placeholder="0700000000"
                        />
                    </div>
                </div>
                <DialogFooter> -->

            <input type="hidden" name="_token" :value="csrfToken">
                    <Input
                            id="phone_number"
                            name="phone_number"
                            placeholder="0700000000"
                        />
                    <Button type="submit" class="bg-green-500 text-white">
                        Pay
                    </Button>
                <!-- </DialogFooter>
            </DialogContent> -->
        </form>
    </Dialog>
</template>
