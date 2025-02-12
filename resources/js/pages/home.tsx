import { AppLayout } from "@/layouts/app-layout";

export default function Home() {

    return (
        <div className="w-full p-6">
            <h1 className="text-2xl font-semibold mb-4">Dashboard</h1>
            <p>Ini adalah halaman utama setelah login.</p>
        </div>

    );
}

Home.layout = (page: React.ReactNode) => <AppLayout children={page} />;
