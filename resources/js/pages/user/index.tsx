import { AppLayout } from "@/layouts/app-layout";

export default function Home() {

    return (
        <div className="grid grid-cols-12 gap-4" >
            Backoffice
        </div>

    );
}

Home.layout = (page: React.ReactNode) => <AppLayout children={page} />;
