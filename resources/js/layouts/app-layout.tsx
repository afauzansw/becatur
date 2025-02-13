import {
    Avatar,
    Button,
    Menu,
    // Sidebar,
    // SidebarContent,
    // SidebarDisclosure,
    // SidebarDisclosureGroup,
    // SidebarDisclosurePanel,
    // SidebarDisclosureTrigger,
    // SidebarFooter,
    // SidebarHeader,
    // SidebarInset,
    // SidebarItem,
    // SidebarLabel,
    // SidebarNav,
    // SidebarProvider,
    // SidebarTrigger
} from "@/components/ui";
import Sidebar from "@/components/ui/sidebar";
import { PagePropsData } from "@/types";
import { Link, useForm, usePage } from "@inertiajs/react";
import {
    IconBook,
    IconCar,
    IconChartAnalytics,
    IconChevronLgDown,
    IconDashboard,
    IconDeviceDesktop,
    IconDevicePhone,
    IconLogout,
    IconMoneybag,
    IconPerson,
    IconPersonPasskey,
    IconSettings,
} from "justd-icons";
import { PropsWithChildren } from "react";
import { toast, Toaster } from "sonner";

export const AppLayout = (props: PropsWithChildren) => {

    const { post, errors } = useForm<any>();

    const page = usePage<PagePropsData>().props;

    const onLogout = (e: { preventDefault: () => void }) => {
        e.preventDefault();

        post(route('auth.logout'), {
            onSuccess: () => {
                toast.success('Successfully created');
            },
            onError: (error) => {
                toast('Whoopsss....', {
                    description: JSON.stringify(error)
                });
            }
        });
    };

    const sections = [
        {
            icon: IconSettings,
            label: "Operational",
            items: [
                {
                    label: "Reservation Payment",
                    icon: IconMoneybag,
                    href: route('web.backoffice.reservation.index')
                },
            ]
        },
        {
            icon: IconBook,
            label: "Master Data",
            items: [
                {
                    label: "Admin",
                    icon: IconPersonPasskey,
                    href: route('web.backoffice.admin.index')
                },
            ]
        },
        {
            icon: IconSettings,
            label: "Settings",
            items: [
                {
                    label: "Application",
                    icon: IconDeviceDesktop,
                    href: route('web.backoffice.setting.index')
                },
            ]
        }
    ]

    return (
        <div className="flex h-screen">
            <div className="w-70 text-white">
                <Sidebar />
            </div>

            <div className="w-full p-10">
                {props.children}
            </div>
        </div>
    )
}
