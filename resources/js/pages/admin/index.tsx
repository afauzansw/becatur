import { Column, DataTable } from "@/components/data-table";
import { Button, Menu, Modal } from "@/components/ui";
import { AppLayout } from "@/layouts/app-layout";
import { Base } from "@/types/base";
import { useForm } from "@inertiajs/react";
import axios from "axios";
import { useState } from "react";
import { toast } from "sonner";

export default function AdminIndex() {

    const [filters, setFilters] = useState({});
    const [id, setId] = useState<any>();
    const { put, data, setData } = useForm<any>();

    const onApprove = (e: { preventDefault: () => void }) => {
        e.preventDefault();

        put(route('web.backoffice.reservation.accept-payment', id), {
            onSuccess: () => {
                toast.success('Data deleted successfully');
            },
            onError: (error) => {
                toast('Whoopsss....', {
                    description: JSON.stringify(error)
                });
            }
        });
    };

    const columns: Column<any>[] = [
        {
            id: 'id',
            header: 'ID',
            cell: (item) => item.id,
            sortable: false,
            isRowHeader: true,
        },
        {
            id: 'name',
            header: 'Name',
            cell: (item) => item.name,
            sortable: false
        },
        {
            id: 'email',
            header: 'Email',
            cell: (item) => item.email,
            sortable: false
        },
        // {
        //     id: 'action',
        //     header: 'Action',
        //     cell: (item) => (
        //         <Menu>
        //             <Menu.Trigger>
        //                 <Button size="extra-small" appearance="outline">Action</Button>
        //             </Menu.Trigger>
        //             <Menu.Content>
        //                 <Menu.Item onAction={() => setId(item.id)} className="hover:bg-[#016243]">
        //                     <IconCircleCheck />
        //                     Approve Payment
        //                 </Menu.Item>
        //             </Menu.Content>
        //         </Menu>
        //     ),
        //     sortable: false
        // },
    ];

    const fetchData = async (params: Record<string, any>) => {
        const response = await axios.get<Base<any[]>>(
            route('web.backoffice.admin.fetch', params)
        );
        return response.data;
    };

    return (
        <>
            {/* <Modal.Content isOpen={id} onOpenChange={() => setId(null)} >
                <Modal.Header>
                    <Modal.Title>Confirmation</Modal.Title>
                    <Modal.Description>
                        You want to approve payment, note this action is irreversible.
                    </Modal.Description>
                </Modal.Header>
                <Modal.Footer>
                    {
                        id && <form onSubmit={onApprove} >
                            <input type="hidden" name="_method" value="DELETE" />
                            <Button intent="custom" type="submit">
                                <IconCircleCheck />
                                Approve Payment
                            </Button>
                        </form>
                    }
                </Modal.Footer>
            </Modal.Content> */}

            <div className="flex justify-between" >
                <div>
                    <h1 className="text-xl font-semibold" >Admin</h1>
                    <p className="text-sm text-gray-600" >Master Data</p>
                </div>
            </div>
            <div className="" >
                <DataTable
                    columns={columns}
                    fetchData={fetchData}
                    filters={filters}
                    onSort={(field, direction) => { }}
                />
            </div>
        </>
    )
}

AdminIndex.layout = (page: React.ReactNode) => <AppLayout children={page} />;
