import { AppLayout } from "@/layouts/app-layout";

export default function Home() {

    return (
        <div className="w-full px-6">
            <h1 className="mb-20 text-2xl font-semibold mb-4">Customer</h1>

            <div className="grid grid-cols-2 gap-10">

            </div>

        </div>
    );
}

Home.layout = (page: React.ReactNode) => <AppLayout children={page} />;
