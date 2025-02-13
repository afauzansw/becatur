import { useState } from "react";
import { Home, Users, CreditCard, Settings, Bike, Calendar, Star, Tag, HelpCircle, Settings2, SettingsIcon } from "lucide-react";

const Sidebar = () => {
    return (
        <div className="h-screen bg-[#016243] text-white flex flex-col px-6 py-10">
            <div className="flex items-center space-x-2 mb-6">
                <img src="/logo.png" alt="Logo" className="h-10 w-auto mx-auto mb-4" />
            </div>
            <nav className="mt-4 flex-1">
                <ul className="space-y-3">
                    <SidebarItem icon={Home} label="Dashboard" href={route('web.backoffice.index')} />
                    <SidebarItem icon={Bike} label="Armada Becak" href="#" />
                    <SidebarItem icon={Calendar} label="Reservasi" href={route('web.backoffice.reservation.index')} />
                    <SidebarItem icon={Users} label="Driver" href={route('web.backoffice.driver.index')} />
                    <SidebarItem icon={Users} label="Customer" href={route('web.backoffice.user.index')} />
                    <SidebarItem icon={Star} label="Ulasan & Feedback" href="#" />
                    <SidebarItem icon={Tag} label="Tarif dan Produk" href="#" />
                    <SidebarItem icon={CreditCard} label="Pembayaran Gaji" href="#" />
                    <SidebarItem icon={Tag} label="Voucher & Koin" href="#" />
                    <SidebarItem icon={Settings} label="Pengaturan" href={route('web.backoffice.setting.index')} />
                    <SidebarItem icon={HelpCircle} label="Bantuan & Panduan" href="#" />
                </ul>
            </nav>
            <button
                // onClick={handleLogout}
                className="p-3 rounded-xl border boder-white w-full text-center "
            >
                <span className="font-semibold">Log out</span>
            </button>
        </div>
    );
};

interface SidebarItemProps {
    icon: React.ElementType;
    label: string;
    href: string;
}

const SidebarItem: React.FC<SidebarItemProps> = ({ icon: Icon, label, href }) => {
    return (
        <li>
            <a href={href} className="flex items-center space-x-3 p-2 rounded-lg hover:bg-green-800 cursor-pointer">
                <Icon size={20} />
                <span className="text-nowrap">{label}</span>
            </a>
        </li>
    );
};

export default Sidebar;
