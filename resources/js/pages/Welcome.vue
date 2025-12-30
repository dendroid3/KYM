<script setup lang="ts">
import MaidCard from '@/components/MaidCard.vue';
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="landing.css" />
    </Head>
    <div class="flex min-h-screen flex-col lg:justify-center lg:p-8">
        <header
            class="mb-6 w-full max-w-[335px] bg-red-600 text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal hover:border-[#19140035] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div class="w-full">
            <main class="w-full">
                <!-- HERO -->
                <header>
                    <h1>
                        Find house helps in Mukurwe-ini with verified documents
                    </h1>
                    <p>
                        Browse registered house helps and unlock contact details
                        after verification.
                    </p>
                    <a href="#househelps" class="cta-button"
                        >View Available House Helps</a
                    >
                    <a href="register" class="cta-button">Register as a House Help</a>
                </header>

                <!-- WHAT THIS PLATFORM DOES -->
                <section>
                    <h2 class="header">What this platform does</h2>
                    <ul>
                        <li>
                            Lists house helps who have registered their details
                        </li>
                        <li>Shows who has verified documents</li>
                        <li>
                            Allows you to unlock contact details for a small fee
                        </li>
                    </ul>
                </section>

                <!-- HOW IT WORKS -->
                <section>
                    <h2 class="header">How it works</h2>
                    <ol>
                        <li>
                            <strong>Browse profiles:</strong> See available
                            house helps, experience, and verification status.
                        </li>
                        <li>
                            <strong>Choose who you like:</strong> Review details
                            and decide who to contact.
                        </li>
                        <li>
                            <strong>Unlock contact details:</strong> Pay a small
                            fee to access phone contact.
                        </li>
                        <li>
                            <strong>Interview and decide:</strong> Speak
                            directly and make your own decision.
                        </li>
                    </ol>
                </section>

                <!-- VERIFIED EXPLANATION -->
                <section>
                    <h2 class="header">What "verified" means</h2>
                    <div class="disclaimer">
                        Verified means the individual presented a valid
                        certificate of good conduct during registration.
                        Verification does not guarantee behavior or suitability.
                        We encourage you to conduct your own interview and
                        checks before hiring.
                    </div>
                </section>

                <!-- AVAILABLE HOUSE HELPS -->
                <section id="househelps">
                    <h2 class="header">Available House Helps</h2>
                    <div class="cards">
                        <MaidCard v-for="value in 15" />
                    </div>
                </section>

                <!-- PRICING -->
                <section>
                    <h2 class="header">Pricing</h2>
                    <p>
                        Unlock contact details:
                        <strong>KSh Y (one-time per contact)</strong>
                    </p>
                    <p>
                        You pay only to access contact details. Employment is
                        agreed between you and the house help directly.
                    </p>
                </section>

                <!-- FOR HOUSE HELPS -->
                <section>
                    <h2 class="header">For House Helps</h2>
                    <p>
                        Register to be listed for job opportunities in
                        Mukurwe-ini. Verified house helps stand out and gain
                        trust with employers.
                    </p>
                    <a href="register" class="cta-button">Register as a House Help</a>
                </section>

                <!-- VERIFICATION PROCESS -->
                <section>
                    <h2 class="header">How verification works</h2>
                    <ol>
                        <li>Register on the platform</li>
                        <li>Obtain a certificate of good conduct</li>
                        <li>
                            Visit <strong>[Shop Name]</strong> in Mukurwe-ini
                            for verification
                        </li>
                        <li>Pay a one-time verification fee</li>
                        <li>Get marked as verified on the platform</li>
                    </ol>
                </section>

                <!-- FAQ -->
                <section>
                    <h2 class="header">Frequently Asked Questions</h2>
                    <div class="faq-item">
                        <strong
                            >Q: Does verification guarantee employment?</strong
                        >
                        <p>
                            A: No. It only shows that documents were presented.
                        </p>
                    </div>
                    <div class="faq-item">
                        <strong>Q: Do you employ house helps?</strong>
                        <p>A: No. We only provide a listing platform.</p>
                    </div>
                    <div class="faq-item">
                        <strong>Q: Is the fee refundable?</strong>
                        <p>
                            A: Fees are for access/verification and are not
                            refundable.
                        </p>
                    </div>
                    <div class="faq-item">
                        <strong
                            >Q: Can I contact house helps without
                            paying?</strong
                        >
                        <p>
                            A: No. Contact details are unlocked after payment.
                        </p>
                    </div>
                </section>

                <!-- FOOTER -->
                <footer>
                    <p>Mukurwe-ini House Help Platform</p>
                    <p>Serving Mukurwe-ini</p>
                    <p>Contact: 07XXXXXXXXX</p>
                    <p>
                        This platform provides listings only and is not
                        responsible for employment agreements.
                    </p>
                </footer>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
