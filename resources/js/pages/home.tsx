import { Header } from "@/components/header";
import { Card } from "@/components/ui";
import { AppLayout } from "@/layouts/app-layout";
import { User } from "lucide-react";

export default function Home() {
    return (
        <div className="w-full px-6">
            <Header title="Dashboard"/>

            <div className="grid grid-cols-2 gap-10">
                <Card.Stats value={0} label="Jumlah Customer" icon={<User size={50} />} />
                <Card.Stats value={0} label="Jumlah Driver Becatur" icon={<User size={50} />} />
                <Card.Stats value={0} label="Jumlah Transaksi Becobeans" icon={<User size={50} />} />
                <Card.Stats value={0} label="Jumlah Transaksi Becobeans" icon={<User size={50} />} />
            </div>

        </div>
    );
}

Home.layout = (page: React.ReactNode) => <AppLayout children={page} />;
