import {
    Avatar,
    Button,
    Menu,
    Sidebar,
    SidebarContent,
    SidebarDisclosure,
    SidebarDisclosureGroup,
    SidebarDisclosurePanel,
    SidebarDisclosureTrigger,
    SidebarFooter,
    SidebarHeader,
    SidebarInset,
    SidebarItem,
    SidebarLabel,
    SidebarNav,
    SidebarProvider,
    SidebarTrigger
} from "@/components/ui";
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
                    href: route('web.backoffice.index')
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
        <SidebarProvider>
            <Sidebar intent="default" collapsible="dock" className="bg-[#016243]" >
                <SidebarHeader>
                    <Link
                        className="flex items-center gap-x-2 group-data-[collapsible=dock]:size-10 group-data-[collapsible=dock]:justify-center text-white"
                        href={route('web.backoffice.index')}
                    >
                        <IconCar className="size-4.5" />
                        <SidebarLabel className="font-medium">Becatur</SidebarLabel>
                    </Link>
                </SidebarHeader>

                <SidebarContent>
                    {sections.map((section, sectionIndex) => (
                        <SidebarDisclosureGroup key={sectionIndex}>
                            <SidebarDisclosure id={sectionIndex + 1}>
                                <SidebarDisclosureTrigger className="text-white hover:text-[#016243]">
                                    <section.icon className="size-4 text-white hover:text-[#016243]" />
                                    <SidebarLabel className="font-medium text-white hover:text-[#016243]" > {section.label}</SidebarLabel>
                                </SidebarDisclosureTrigger>
                                <SidebarDisclosurePanel>
                                    {section.items.map((item, itemIndex) => (
                                        <SidebarItem className="hover:text-[#016243]" key={itemIndex} href={item.href}>
                                            {({ isHovered }) => (
                                                <>
                                                    <item.icon className="text-white hover:text-[#016243] size-4" />
                                                    <SidebarLabel className="text-white hover:text-[#016243]" >{item.label}</SidebarLabel>
                                                </>
                                            )}
                                        </SidebarItem>
                                    ))}
                                </SidebarDisclosurePanel>
                            </SidebarDisclosure>
                        </SidebarDisclosureGroup>
                    ))}
                </SidebarContent>

                <SidebarFooter>
                    <Menu>
                        <Menu.Trigger aria-label="Profile" data-slot="menu-trigger">
                            <Avatar shape="square" src="" />
                            <div className="text-sm group-data-[collapsible=dock]:hidden">
                                {page.auth?.user?.name ?? '-'}
                                <span className="block -mt-0.5 text-muted-fg">{page.auth?.user?.email ?? '-'}</span>
                            </div>
                            <IconChevronLgDown className="absolute right-3 transition-transform size-4 group-pressed:rotate-180" />
                        </Menu.Trigger>
                        <Menu.Content placement="bottom right" className="sm:min-w-(--trigger-width)">
                            <Menu.Section>
                                <Menu.Header separator>
                                    <span className="block">{page.auth?.user?.name ?? '-'}</span>
                                    <span className="font-normal text-muted-fg">@cobain</span>
                                </Menu.Header>
                            </Menu.Section>

                            <Menu.Item href="#">
                                <IconLogout />
                                <button onClick={onLogout} className="flex w-full">
                                    Log out
                                </button>
                            </Menu.Item>
                        </Menu.Content>
                    </Menu>
                </SidebarFooter>
            </Sidebar>
            <SidebarInset>
                <SidebarNav className="flex justify-between w-full" >
                    <span className="flex gap-x-4 items-center justify-between w-full">
                        <SidebarTrigger className="-mx-2" />
                        <Button appearance="outline" size="extra-small" >
                            <IconChartAnalytics />
                        </Button>
                    </span>

                </SidebarNav>
                <div className="p-5 max-w-full">
                    <Toaster />
                    {props.children}
                </div>
            </SidebarInset>
        </SidebarProvider>
    )
}
